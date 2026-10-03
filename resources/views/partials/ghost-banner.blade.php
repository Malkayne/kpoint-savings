@if(!empty($isSuperadminGhostMode) && !empty($ghostOrg))
<div style="background:#1a1a2e;color:#e94560;padding:8px 16px;font-size:12px;text-align:center;z-index:9999;position:relative;width:100%;">
    SUPERADMIN GHOST MODE — Viewing as: <strong>{{ $ghostOrg->name }}</strong>
    <a href="{{ route('superadmin.exit-org') }}" style="color:#f5a623;margin-left:20px;">Exit Org</a>
</div>
@endif
