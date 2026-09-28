<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\AdminWallet;
use App\Models\ContributionPlan;
use App\Models\Organisation;
use App\Models\Rep;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Models\Superadmin;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TenantIsolationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_registration_page_does_not_list_reps()
    {
        $rep = Rep::withoutTenantScope()->where('status', 'active')->first();

        $this->get('/register')
            ->assertStatus(200)
            ->assertDontSee('Select Referral')
            ->assertDontSee('('.$rep->username.')');
    }

    public function test_registration_copies_the_rep_org_onto_the_member_and_wallet()
    {
        $rep = Rep::withoutTenantScope()->where('org_id', 1)->where('status', 'active')->first();
        $username = 'member'.time();

        $response = $this->post('/register', [
            'name' => 'Tenant Member',
            'username' => $username,
            'email' => $username.'@example.com',
            'phone' => '080'.substr(time(), -8),
            'address' => '1 Test Street',
            'nok_name' => 'Kin',
            'nok_phone' => '08000000000',
            'nok_relationship' => 'Sibling',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'rep_username' => $rep->username,
            'signature' => UploadedFile::fake()->create('sig.png', 12),
            'profile_pix' => UploadedFile::fake()->create('pic.png', 12),
        ]);

        $response->assertRedirect('/userend/dashboard');

        $user = User::withoutTenantScope()->where('username', $username)->first();
        $this->assertNotNull($user);
        $this->assertEquals($rep->org_id, $user->org_id);
        $this->assertEquals($rep->id, $user->rep_id);

        $wallet = Wallet::withoutTenantScope()->where('user_id', $user->id)->first();
        $this->assertNotNull($wallet);
        $this->assertEquals($rep->org_id, (int) $wallet->org_id);

        $this->assertFalse(
            User::withoutTenantScope()->where('accNum', $user->accNum)->where('id', '!=', $user->id)->exists()
        );

        if ($user->signature) {
            @unlink(base_path('public/Images/Signatures/'.$user->signature));
        }
        if ($user->profile_pix) {
            @unlink(base_path('public/Images/ProfilePics/'.$user->profile_pix));
        }
    }

    public function test_org_admin_cannot_open_another_orgs_records()
    {
        $foreign = $this->makeForeignOrg();
        $localUser = User::withoutTenantScope()->where('org_id', 1)->first();
        $localPlan = ContributionPlan::withoutTenantScope()->where('org_id', 1)->first();
        $localWithdrawal = Withdrawal::withoutTenantScope()->where('org_id', 1)->first();

        $this->actingAs($foreign['admin'], 'admin');

        $this->get('/admin/userDetails/'.$localUser->id)->assertStatus(404);
        $this->get('/admin/plans/'.$localPlan->id.'/details')->assertStatus(404);
        $this->get('/admin/pendingUserCredit/'.$localUser->id)->assertStatus(404);

        if ($localWithdrawal) {
            $this->post('/admin/withdrawal/'.$localWithdrawal->id.'/update-status', [
                'status' => 'pending',
            ])->assertStatus(404);
        }

        $this->assertEquals(0, User::where('id', $localUser->id)->count());
    }

    public function test_ghost_mode_in_one_org_does_not_change_another_org_wallet()
    {
        $foreign = $this->makeForeignOrg();
        $localAdmin = Admin::withoutTenantScope()->where('org_id', 1)->first();
        $localPlan = ContributionPlan::withoutTenantScope()->where('org_id', 1)->first();

        $wallet = AdminWallet::withoutTenantScope()->updateOrCreate(
            ['org_id' => 1],
            ['admin_id' => $localAdmin->id, 'amount' => 321.5]
        );
        $before = (string) $wallet->fresh()->amount;

        $superadmin = Superadmin::first();

        $this->actingAs($superadmin, 'superadmin')
            ->withSession([
                'acting_org_id' => $foreign['org']->id,
                'acting_as_superadmin' => true,
            ])
            ->get('/admin/breakPlan/'.$localPlan->id);

        $after = AdminWallet::withoutTenantScope()->where('org_id', 1)->first();
        $this->assertEquals($before, (string) $after->amount);
        $this->assertEquals(
            ContributionPlan::withoutTenantScope()->where('id', $localPlan->id)->value('status'),
            $localPlan->status
        );
    }

    public function test_a_real_admin_session_is_not_retargeted_by_ghost_mode()
    {
        $foreign = $this->makeForeignOrg();
        $localAdmin = Admin::withoutTenantScope()->where('org_id', 1)->first();
        $localUser = User::withoutTenantScope()->where('org_id', 1)->first();

        $this->actingAs($localAdmin, 'admin')
            ->actingAs(Superadmin::first(), 'superadmin')
            ->withSession([
                'acting_org_id' => $foreign['org']->id,
                'acting_as_superadmin' => true,
            ])
            ->get('/admin/userDetails/'.$localUser->id)
            ->assertStatus(200);
    }

    public function test_suspended_org_cannot_open_the_admin_dashboard()
    {
        $foreign = $this->makeForeignOrg();
        $foreign['org']->update(['status' => 'suspended']);

        $this->actingAs($foreign['admin'], 'admin')
            ->get('/admin/dashboard')
            ->assertStatus(403);
    }

    public function test_member_profile_cannot_change_org_wallet_or_password()
    {
        $foreign = $this->makeForeignOrg();
        $user = User::withoutTenantScope()->where('org_id', 1)->where('status', 'active')->first();
        $password = $user->password;
        $balance = $user->wallet_balance;

        $this->actingAs($user)
            ->put('/userend/updateProfile', [
                'name' => $user->name,
                'username' => $user->username,
                'phone' => $user->phone ?: '08000000000',
                'address' => $user->address ?: 'Test address',
                'nok_name' => $user->nok_name ?: 'Kin',
                'nok_phone' => $user->nok_phone ?: '08000000001',
                'nok_relationship' => $user->nok_relationship ?: 'sibling',
                'org_id' => $foreign['org']->id,
                'wallet_balance' => 999999,
                'password' => 'hacked-password',
            ])
            ->assertRedirect('/userend/profile');

        $fresh = User::withoutTenantScope()->find($user->id);
        $this->assertEquals(1, (int) $fresh->org_id);
        $this->assertEquals((string) $balance, (string) $fresh->wallet_balance);
        $this->assertEquals($password, $fresh->password);
    }

    public function test_user_search_cannot_return_another_org()
    {
        $foreign = $this->makeForeignOrg();
        $local = User::withoutTenantScope()->where('org_id', 1)->first();
        $suffix = substr(uniqid(), -6);
        $name = 'Zzxleak'.$suffix;

        $copy = $local->replicate();
        $copy->name = $name;
        $copy->username = 'leak'.$suffix;
        $copy->email = 'leak'.$suffix.'@example.com';
        $copy->accNum = '1002999'.$suffix;
        $copy->org_id = $foreign['org']->id;
        $copy->save();

        app(\App\Services\TenantContext::class)->set(1);

        $request = \Illuminate\Http\Request::create('/search', 'GET', ['q' => $name]);
        $payload = json_decode(
            app(\App\Http\Controllers\Admin\DefaultController::class)->searchUsers($request)->getContent(),
            true
        );

        $this->assertSame([], $payload);
    }

    /**
     * @return array
     */
    protected function makeForeignOrg()
    {
        $suffix = substr(uniqid(), -6);

        $org = Organisation::create([
            'name' => 'Foreign Org '.$suffix,
            'slug' => 'foreign-'.$suffix,
            'email' => 'foreign'.$suffix.'@example.com',
            'status' => 'active',
        ]);

        $admin = new Admin();
        $admin->timestamps = false;
        $admin->fill([
            'org_id' => $org->id,
            'name' => 'Foreign Admin',
            'email' => 'fadmin'.$suffix.'@example.com',
            'username' => 'fadmin'.$suffix,
            'password' => Hash::make('password123'),
        ]);
        $admin->save();

        AdminWallet::withoutTenantScope()->create([
            'org_id' => $org->id,
            'admin_id' => $admin->id,
            'amount' => 10,
        ]);

        return ['org' => $org, 'admin' => $admin];
    }
}
