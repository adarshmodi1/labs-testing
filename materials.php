<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<title>Materials — BoutiqBiz</title>
<style>
:root {
  --p:#4A3BB5;--pl:#EEEDFE;--pm:#AFA9EC;--pt:#3C3489;
  --g:#1D9E75;--gl:#EAF3DE;--gt:#3B6D11;
  --r:#E24B4A;--rl:#FCEBEB;--rt:#A32D2D;
  --a:#BA7517;--al:#FAEEDA;--at:#854F0B;
  --b:#185FA5;--bl:#E6F1FB;--bt:#0C447C;
  --bg:#F4F3FB;--sf:#ffffff;--sf2:#F7F6FD;
  --br:rgba(74,59,181,0.11);--br2:rgba(74,59,181,0.2);
  --tx:#1A1740;--tx2:#6B6494;--tx3:#A09CC0;
}
*{box-sizing:border-box;margin:0;padding:0;-webkit-tap-highlight-color:transparent;}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;font-size:14px;color:var(--tx);background:var(--bg);overflow-x:hidden;}
.screen{display:none;}
.screen.on{display:flex;flex-direction:column;min-height:100dvh;}
.sh-ov{display:none;position:fixed;inset:0;z-index:500;flex-direction:column;justify-content:flex-end;background:rgba(10,8,40,0.42);}
.sh-ov.open{display:flex;}
.sh{background:var(--sf);border-radius:20px 20px 0 0;padding:0 0 24px;max-height:90dvh;overflow-y:auto;}
.sh-handle{width:36px;height:4px;background:var(--br2);border-radius:2px;margin:12px auto 16px;}
.sh-hd{display:flex;align-items:center;justify-content:space-between;padding:0 16px 12px;}
.sh-hd h3{font-size:16px;font-weight:600;}
.tb{background:var(--p);color:#fff;display:flex;align-items:center;gap:8px;padding:20px 16px 14px;position:sticky;top:0;z-index:100;}
.tb h1{font-size:17px;font-weight:600;flex:1;margin:0;}
.tb .sub{font-size:12px;opacity:0.8;}
.tb-bk{width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,0.16);border:none;display:flex;align-items:center;justify-content:center;color:#fff;cursor:pointer;flex-shrink:0;}
.tb-act{background:rgba(255,255,255,0.16);border:none;border-radius:8px;padding:6px 10px;color:#fff;cursor:pointer;font-size:13px;font-weight:500;display:flex;align-items:center;gap:4px;}
.tb-add{background:var(--g);border:none;border-radius:20px;padding:6px 14px;color:#fff;cursor:pointer;font-size:13px;font-weight:600;}
.tab-strip{background:var(--p);padding:0 16px 8px;overflow-x:auto;scrollbar-width:none;}
.tab-strip::-webkit-scrollbar{display:none;}
.tab-inner{display:flex;gap:4px;}
.tab{padding:6px 14px;border-radius:20px;font-size:13px;font-weight:500;color:rgba(255,255,255,0.7);background:transparent;border:none;cursor:pointer;white-space:nowrap;}
.tab.on{background:#fff;color:var(--pt);}
.body{flex:1;padding:16px;display:flex;flex-direction:column;gap:12px;}
.card{background:var(--sf);border-radius:14px;padding:14px 16px;}
.row{display:flex;align-items:center;gap:8px;}
.row-between{display:flex;align-items:center;justify-content:space-between;}
input,select,textarea{background:var(--sf2);border:1.5px solid var(--br);border-radius:10px;padding:10px 12px;font-size:14px;color:var(--tx);width:100%;font-family:inherit;}
input:focus,select:focus,textarea:focus{outline:none;border-color:var(--p);}
label{font-size:12px;color:var(--tx2);font-weight:500;display:block;margin-bottom:4px;}
.fld{margin-bottom:12px;}
.btn-p{background:var(--p);color:#fff;border:none;border-radius:12px;padding:13px 20px;font-size:15px;font-weight:600;cursor:pointer;width:100%;}
.btn-s{background:var(--sf);color:var(--p);border:1.5px solid var(--br2);border-radius:12px;padding:11px 20px;font-size:14px;font-weight:600;cursor:pointer;}
.btn-sm{background:var(--pl);color:var(--pt);border:none;border-radius:8px;padding:6px 12px;font-size:13px;font-weight:500;cursor:pointer;}
.btn-ghost{background:none;border:none;cursor:pointer;color:var(--tx2);display:flex;align-items:center;gap:4px;font-size:13px;padding:4px;}
.btn-danger{background:var(--rl);color:var(--rt);border:none;border-radius:8px;padding:6px 12px;font-size:13px;cursor:pointer;}
.chip{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500;}
.chip-f{background:var(--pl);color:var(--pt);}
.chip-r{background:var(--al);color:var(--at);}
.chip-p{background:var(--bl);color:var(--bt);}
.chip-ok{background:var(--gl);color:var(--gt);}
.chip-low{background:var(--al);color:var(--at);}
.chip-out{background:var(--rl);color:var(--rt);}
.dot{width:8px;height:8px;border-radius:50%;display:inline-block;flex-shrink:0;}
.dot-ok{background:var(--g);}
.dot-low{background:var(--a);}
.dot-out{background:var(--r);}
.mat-row{background:var(--sf);border-radius:12px;padding:12px 14px;display:flex;align-items:center;gap:10px;cursor:pointer;border:1px solid var(--br);}
.mat-row:active{background:var(--sf2);}
.mat-info{flex:1;min-width:0;}
.mat-name{font-weight:600;font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.mat-sku{font-size:12px;color:var(--tx3);}
.mat-right{display:flex;align-items:center;gap:8px;flex-shrink:0;}
.mat-qty{font-size:14px;font-weight:600;color:var(--tx);}
.mat-unit{font-size:11px;color:var(--tx3);}
.views-bar{background:var(--p);padding:8px 16px;overflow-x:auto;scrollbar-width:none;}
.views-bar::-webkit-scrollbar{display:none;}
.views-inner{display:flex;gap:6px;white-space:nowrap;}
.view-pill{padding:5px 14px;border-radius:20px;font-size:13px;font-weight:500;cursor:pointer;border:1px solid rgba(255,255,255,0.3);background:transparent;color:rgba(255,255,255,0.75);}
.view-pill.on{background:#fff;color:var(--pt);border-color:#fff;}
.view-pill-new{padding:5px 14px;border-radius:20px;font-size:13px;font-weight:500;cursor:pointer;border:1.5px dashed rgba(255,255,255,0.4);background:transparent;color:rgba(255,255,255,0.65);}
.ctrl-row{display:flex;align-items:center;gap:8px;padding:10px 16px 0;}
.search-wrap{flex:1;position:relative;}
.search-wrap input{padding-left:36px;padding-top:8px;padding-bottom:8px;}
.search-icon{position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--tx3);pointer-events:none;}
.icon-btn{width:36px;height:36px;border-radius:10px;background:var(--sf);border:1.5px solid var(--br);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--tx2);flex-shrink:0;}
.meta-row{padding:6px 16px;font-size:12px;color:var(--tx3);}
.list-wrap{padding:0 16px;display:flex;flex-direction:column;gap:8px;padding-bottom:24px;}
.empty-state{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;padding:60px 20px;color:var(--tx3);text-align:center;}
.empty-state svg{opacity:0.3;}
.sect-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;}
.sect-hd h3{font-size:15px;font-weight:600;}
.divider{height:1px;background:var(--br);margin:12px 0;}
.stat-row{display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;}
.stat-tile{background:var(--sf2);border-radius:10px;padding:10px 12px;text-align:center;}
.stat-val{font-size:20px;font-weight:700;color:var(--tx);}
.stat-lbl{font-size:11px;color:var(--tx2);margin-top:2px;}
.loc-row{display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--br);}
.loc-row:last-child{border-bottom:none;}
.move-row{display:flex;align-items:flex-start;gap:10px;padding:10px 0;border-bottom:1px solid var(--br);}
.move-row:last-child{border-bottom:none;}
.move-dot{width:8px;height:8px;border-radius:50%;margin-top:5px;flex-shrink:0;}
.move-in{background:var(--g);}
.move-out{background:var(--r);}
.move-adj{background:var(--a);}
.move-body{flex:1;}
.move-type{font-size:13px;font-weight:600;}
.move-sub{font-size:12px;color:var(--tx2);}
.move-qty{font-size:14px;font-weight:600;}
.bom-row{display:flex;align-items:center;gap:8px;padding:10px 0;border-bottom:1px solid var(--br);}
.bom-row:last-child{border-bottom:none;}
.bom-info{flex:1;}
.bom-mat{font-size:13px;font-weight:600;}
.bom-note{font-size:12px;color:var(--tx2);}
.bom-qty{font-size:13px;font-weight:600;color:var(--p);white-space:nowrap;}
.tag-inherited{background:var(--sf2);color:var(--tx3);border-radius:4px;padding:1px 6px;font-size:11px;}
.tag-override{background:var(--al);color:var(--at);border-radius:4px;padding:1px 6px;font-size:11px;}
.var-row{display:flex;align-items:center;gap:10px;padding:12px 0;border-bottom:1px solid var(--br);}
.var-row:last-child{border-bottom:none;}
.var-swatch{width:20px;height:20px;border-radius:50%;flex-shrink:0;}
.var-info{flex:1;}
.var-name{font-size:13px;font-weight:600;}
.var-sku{font-size:12px;color:var(--tx3);}
.var-actions{display:flex;gap:6px;}
.in-item{background:var(--sf2);border-radius:10px;padding:10px 12px;margin-bottom:8px;}
.in-item-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;}
.in-item-mat{font-weight:600;font-size:13px;}
.in-item-fields{display:grid;grid-template-columns:1fr 1fr;gap:8px;}
.coll-card{background:var(--sf);border-radius:14px;padding:14px 16px;cursor:pointer;border:1px solid var(--br);}
.coll-hd{display:flex;align-items:center;gap:10px;margin-bottom:10px;}
.coll-dot{width:16px;height:16px;border-radius:50%;flex-shrink:0;}
.coll-name{font-size:15px;font-weight:600;}
.coll-count{font-size:12px;color:var(--tx2);}
.coll-thumbs{display:flex;gap:4px;}
.coll-thumb{width:40px;height:40px;border-radius:8px;background:var(--sf2);display:flex;align-items:center;justify-content:center;font-size:18px;}
.req-row{background:var(--sf);border-radius:12px;padding:12px 14px;border:1px solid var(--br);cursor:pointer;}
.req-client{font-weight:600;font-size:14px;}
.req-product{font-size:12px;color:var(--tx2);margin-top:2px;}
.req-meta{display:flex;align-items:center;gap:8px;margin-top:6px;}
.lbl-card{background:var(--sf);border-radius:12px;padding:12px;border:1px solid var(--br);}
.lbl-name{font-weight:600;font-size:14px;margin-bottom:4px;}
.lbl-size{font-size:12px;color:var(--tx3);}
.lbl-fields{font-size:11px;color:var(--tx2);margin-top:6px;}
.lbl-card-actions{display:flex;gap:8px;margin-top:10px;padding-top:10px;border-top:1px solid var(--br);}
.q-row{display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--br);}
.q-row:last-child{border-bottom:none;}
.q-info{flex:1;}
.preview-label{background:var(--sf);border-radius:16px;padding:20px;min-height:120px;display:flex;flex-direction:column;justify-content:center;align-items:center;border:2px dashed var(--br2);gap:6px;}
.preview-label .pl-name{font-size:16px;font-weight:700;}
.preview-label .pl-var{font-size:13px;color:var(--tx2);}
.preview-label .pl-price{font-size:20px;font-weight:700;color:var(--p);}
.preview-label .pl-sku{font-size:11px;color:var(--tx3);}
.toggle-row{display:flex;align-items:center;justify-content:space-between;}
.toggle{position:relative;width:44px;height:24px;cursor:pointer;}
.toggle input{opacity:0;width:0;height:0;}
.toggle-slider{position:absolute;inset:0;background:var(--br2);border-radius:12px;transition:0.2s;}
.toggle input:checked + .toggle-slider{background:var(--p);}
.toggle-slider:before{content:'';position:absolute;width:18px;height:18px;left:3px;bottom:3px;background:#fff;border-radius:50%;transition:0.2s;}
.toggle input:checked + .toggle-slider:before{transform:translateX(20px);}
.opt-row{display:flex;align-items:center;gap:8px;padding:10px 0;border-bottom:1px solid var(--br);}
.opt-row:last-child{border-bottom:none;}
.opt-info{flex:1;}
.opt-name{font-size:14px;font-weight:600;}
.opt-vals{font-size:12px;color:var(--tx2);margin-top:2px;}
.color-swatches{display:flex;gap:8px;flex-wrap:wrap;}
.color-swatch{width:28px;height:28px;border-radius:50%;cursor:pointer;border:3px solid transparent;}
.color-swatch.sel{border-color:var(--tx);}
.nav-item{display:flex;align-items:center;gap:14px;padding:14px 16px;cursor:pointer;border-radius:12px;}
.nav-item:active{background:var(--sf2);}
.nav-item-label{font-size:15px;font-weight:500;}
.nav-logo{font-size:20px;font-weight:700;color:var(--p);}
.nav-store{font-size:13px;color:var(--tx2);}
.filter-opt{display:flex;align-items:center;gap:8px;padding:10px 0;cursor:pointer;}
.filter-opt input[type=radio],.filter-opt input[type=checkbox]{width:18px;height:18px;accent-color:var(--p);}
.sort-opt{display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid var(--br);cursor:pointer;}
.sort-opt:last-child{border-bottom:none;}
.col-opt{display:flex;align-items:center;gap:10px;padding:10px 0;cursor:pointer;}
.col-opt input{width:18px;height:18px;accent-color:var(--p);}
.sh-body{padding:0 16px 12px;}
.sh-footer{padding:12px 16px 0;display:flex;gap:8px;}
.sparkline{display:block;width:100%;height:60px;}
.prod-section{margin-bottom:20px;}
.prod-section-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;}
.prod-section-title{font-size:15px;font-weight:600;}
.lot-row{background:var(--sf2);border-radius:10px;padding:10px 12px;margin-bottom:6px;display:flex;align-items:center;gap:10px;}
.lot-info{flex:1;}
.lot-no{font-size:13px;font-weight:600;}
.lot-sub{font-size:12px;color:var(--tx2);}
.vendor-row{display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--br);}
.vendor-row:last-child{border-bottom:none;}
.vendor-info{flex:1;}
.costing-row{display:flex;align-items:center;gap:8px;padding:8px 0;border-bottom:1px solid var(--br);}
.costing-row:last-child{border-bottom:none;}
.costing-desc{flex:1;font-size:13px;}
.costing-amt{font-size:14px;font-weight:600;}
.badge{display:inline-flex;align-items:center;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600;}
.badge-grey{background:var(--sf2);color:var(--tx2);}
.badge-amber{background:var(--al);color:var(--at);}
.p-14{padding:14px;}
.px-16{padding-left:16px;padding-right:16px;}
.py-8{padding-top:8px;padding-bottom:8px;}
.gap-8{gap:8px;}
.gap-12{gap:12px;}
.gap-16{gap:16px;}
.mt-8{margin-top:8px;}
.mt-12{margin-top:12px;}
.mb-8{margin-bottom:8px;}
.mb-12{margin-bottom:12px;}
.fs-12{font-size:12px;}
.fs-13{font-size:13px;}
.fs-16{font-size:16px;}
.fw-6{font-weight:600;}
.tx2{color:var(--tx2);}
.tx3{color:var(--tx3);}
.txp{color:var(--p);}
.w-full{width:100%;}
.flex-1{flex:1;}
.text-center{text-align:center;}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.note{font-size:12px;color:var(--tx2);padding:10px 12px;background:var(--sf2);border-radius:8px;line-height:1.5;}
</style>
</head>
<body>

<!-- s-list: Material List -->
<div id="s-list" class="screen on">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')" aria-label="Menu">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Materials</h1>
    <button class="tb-bk" onclick="openSheet('sh-cols')" aria-label="Columns">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
    </button>
    <button class="tb-add" onclick="openCreate(null)">+ Add</button>
  </div>
  <div class="views-bar" id="views-bar">
    <div class="views-inner" id="views-inner"></div>
  </div>
  <div class="ctrl-row">
    <div class="search-wrap">
      <span class="search-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></span>
      <input type="search" id="list-search" placeholder="Search materials…" oninput="renderList()">
    </div>
    <div class="icon-btn" onclick="openSheet('sh-sort')">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="6" y1="12" x2="18" y2="12"/><line x1="9" y1="18" x2="15" y2="18"/></svg>
    </div>
    <div class="icon-btn" onclick="openSheet('sh-filter')">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
    </div>
  </div>
  <div class="meta-row" id="list-meta"></div>
  <div class="list-wrap" id="list-wrap"></div>
</div>

<!-- s-mat-in: Material In -->
<div id="s-mat-in" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1>Material In</h1>
    <button class="tb-act" onclick="saveMatIn()">Save</button>
  </div>
  <div class="body">
    <div class="card">
      <div class="fld">
        <label>Entry No.</label>
        <input type="text" id="mi-entryno" readonly>
      </div>
      <div class="fld">
        <label>Date</label>
        <input type="date" id="mi-date">
      </div>
      <div class="fld">
        <label>Type</label>
        <select id="mi-type">
          <option value="purchase">Purchase</option>
          <option value="return-jobber">Return from Jobber</option>
          <option value="return-customer">Return from Customer</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div class="fld">
        <label>Vendor</label>
        <input type="text" id="mi-vendor" placeholder="Vendor name">
      </div>
      <div class="fld">
        <label>Invoice Ref</label>
        <input type="text" id="mi-invref" placeholder="INV-001">
      </div>
      <div class="fld">
        <label>Notes</label>
        <textarea id="mi-notes" rows="2" placeholder="Optional notes"></textarea>
      </div>
    </div>
    <div class="card">
      <div class="sect-hd">
        <h3>Items</h3>
        <button class="btn-sm" onclick="addMatInItem()">+ Add item</button>
      </div>
      <div id="mi-items"></div>
      <div class="divider"></div>
      <div class="row-between mb-8">
        <span class="tx2 fs-13">Subtotal</span>
        <span class="fw-6" id="mi-subtotal">₹0</span>
      </div>
      <div class="toggle-row mb-8">
        <span class="tx2 fs-13">GST applicable</span>
        <label class="toggle">
          <input type="checkbox" id="mi-gst-toggle" onchange="toggleMiGst()">
          <span class="toggle-slider"></span>
        </label>
      </div>
      <div id="mi-gst-row" style="display:none;margin-bottom:8px;">
        <div class="row gap-8">
          <span class="tx2 fs-13">GST %</span>
          <input type="number" id="mi-gst-pct" value="18" style="width:80px;" oninput="calcMiTotal()">
          <span class="fw-6" id="mi-gst-amt">₹0</span>
        </div>
      </div>
      <div class="row-between">
        <span class="fw-6">Grand Total</span>
        <span class="fw-6 txp fs-16" id="mi-grand-total">₹0</span>
      </div>
    </div>
    <button class="btn-p" onclick="saveMatIn()">Save Entry</button>
  </div>
</div>

<!-- s-mat-out: Material Out -->
<div id="s-mat-out" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1>Material Out</h1>
    <button class="tb-act" onclick="saveMatOut()">Save</button>
  </div>
  <div class="body">
    <div class="card">
      <div class="fld">
        <label>Entry No.</label>
        <input type="text" id="mo-entryno" readonly>
      </div>
      <div class="fld">
        <label>Date</label>
        <input type="date" id="mo-date">
      </div>
      <div class="fld">
        <label>Out Type</label>
        <select id="mo-type" onchange="renderMoRecipient()">
          <option value="jobber">To Jobber</option>
          <option value="customer">To Customer</option>
          <option value="sales">Sales</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div id="mo-recipient-fields"></div>
      <div class="fld">
        <label>Notes</label>
        <textarea id="mo-notes" rows="2" placeholder="Optional notes"></textarea>
      </div>
    </div>
    <div class="card">
      <div class="sect-hd">
        <h3>Items</h3>
        <button class="btn-sm" onclick="addMatOutItem()">+ Add item</button>
      </div>
      <div id="mo-items"></div>
      <div class="divider"></div>
      <div class="row-between">
        <span class="fw-6">Total</span>
        <span class="fw-6 txp fs-16" id="mo-total">₹0</span>
      </div>
    </div>
    <button class="btn-p" onclick="saveMatOut()">Save Entry</button>
  </div>
</div>

<!-- s-create: Create/Edit Material -->
<div id="s-create" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1 id="create-title">New Material</h1>
    <button class="tb-act" onclick="saveCreate()">Save</button>
  </div>
  <div class="tab-strip">
    <div class="tab-inner">
      <button class="tab on" onclick="setCTab(0)">Info</button>
      <button class="tab" onclick="setCTab(1)">Variants</button>
      <button class="tab" onclick="setCTab(2)">Movement</button>
    </div>
  </div>
  <div id="c-tab-info" class="body" style="display:flex;"></div>
  <div id="c-tab-variants" class="body" style="display:none;"></div>
  <div id="c-tab-movement" class="body" style="display:none;"></div>
</div>

<!-- s-vdetail: Variant Detail -->
<div id="s-vdetail" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <div style="flex:1;min-width:0;">
      <div class="fw-6 fs-16" id="vd-title" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#fff;"></div>
      <div class="sub" id="vd-sub"></div>
    </div>
    <button class="tb-bk" onclick="openCreate(window._vdMatId)">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    </button>
  </div>
  <div class="tab-strip">
    <div class="tab-inner">
      <button class="tab on" onclick="setVTab(0)">Pricing</button>
      <button class="tab" onclick="setVTab(1)">Inventory</button>
      <button class="tab" onclick="setVTab(2)">BOM & TechPack</button>
      <button class="tab" onclick="setVTab(3)">Costing</button>
      <button class="tab" onclick="setVTab(4)">Production</button>
    </div>
  </div>
  <div id="vd-tab-0" class="body" style="display:flex;"></div>
  <div id="vd-tab-1" class="body" style="display:none;"></div>
  <div id="vd-tab-2" class="body" style="display:none;"></div>
  <div id="vd-tab-3" class="body" style="display:none;"></div>
  <div id="vd-tab-4" class="body" style="display:none;"></div>
</div>

<!-- s-mdetail: Material Detail -->
<div id="s-mdetail" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1 id="md-title"></h1>
    <button class="tb-bk" onclick="openCreate(window._mdMatId)">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    </button>
  </div>
  <div id="md-summary" class="px-16 py-8"></div>
  <div class="tab-strip">
    <div class="tab-inner">
      <button class="tab on" onclick="setMTab(0)">Variants</button>
      <button class="tab" onclick="setMTab(1)">Supply</button>
      <button class="tab" onclick="setMTab(2)">Production</button>
      <button class="tab" onclick="setMTab(3)">Collections</button>
    </div>
  </div>
  <div id="md-tab-0" class="body" style="display:flex;"></div>
  <div id="md-tab-1" class="body" style="display:none;"></div>
  <div id="md-tab-2" class="body" style="display:none;"></div>
  <div id="md-tab-3" class="body" style="display:none;"></div>
</div>

<!-- s-labels: Print Labels -->
<div id="s-labels" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Print Labels</h1>
  </div>
  <div id="labels-body" style="flex:1;display:flex;flex-direction:column;"></div>
</div>

<!-- s-label-preview: Label Preview -->
<div id="s-label-preview" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1>Label Preview</h1>
    <button class="tb-act" onclick="window.print()">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
      Print
    </button>
  </div>
  <div class="body">
    <div id="lp-label" class="preview-label"></div>
    <div class="card mt-12">
      <div class="fld">
        <label>Printer</label>
        <select><option>Default printer</option></select>
      </div>
      <div class="fld">
        <label>Quantity</label>
        <div class="row gap-8">
          <button class="icon-btn" onclick="lpQtyAdj(-1)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </button>
          <input type="number" id="lp-qty" value="1" min="1" style="text-align:center;width:80px;">
          <button class="icon-btn" onclick="lpQtyAdj(1)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </button>
        </div>
      </div>
    </div>
    <button class="btn-p mt-12" onclick="window.print()">Print Labels</button>
  </div>
</div>

<!-- s-collections: Collections -->
<div id="s-collections" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Collections</h1>
    <button class="tb-add" onclick="openNewCol()">+ New</button>
  </div>
  <div class="body" id="collections-body"></div>
</div>

<!-- s-cdetail: Collection Detail -->
<div id="s-cdetail" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1 id="cd-title"></h1>
    <button class="tb-bk" onclick="openSheet('sh-sharelink')">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
    </button>
    <button class="tb-bk" onclick="openEditCol(window._cdColId)">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    </button>
  </div>
  <div class="body" id="cd-body"></div>
</div>

<!-- s-order-requests: Client Order Requests -->
<div id="s-order-requests" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Client Order Requests</h1>
    <div class="icon-btn" onclick="openSheet('sh-filter')">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
    </div>
  </div>
  <div class="px-16" style="padding-top:10px;overflow-x:auto;scrollbar-width:none;">
    <div style="display:flex;gap:6px;white-space:nowrap;">
      <button class="view-pill on" id="req-f-all" onclick="setReqFilter('all')">All</button>
      <button class="view-pill" id="req-f-pending" onclick="setReqFilter('pending')">Pending</button>
      <button class="view-pill" id="req-f-acknowledged" onclick="setReqFilter('acknowledged')">Acknowledged</button>
      <button class="view-pill" id="req-f-converted" onclick="setReqFilter('converted')">Converted</button>
      <button class="view-pill" id="req-f-rejected" onclick="setReqFilter('rejected')">Rejected</button>
    </div>
  </div>
  <div class="body" id="req-body"></div>
</div>

<!-- s-sync: Sync Inventory -->
<div id="s-sync" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Sync Inventory</h1>
  </div>
  <div class="body">
    <div class="card">
      <div class="sect-hd"><h3>CSV Import</h3></div>
      <p class="tx2 fs-13 mb-8">Download the template, fill in your stock data, then upload to apply.</p>
      <button class="btn-s w-full mb-8" onclick="showToast('Template downloaded','info')">Download Template</button>
      <div class="fld">
        <label>Upload CSV</label>
        <input type="file" accept=".csv">
      </div>
      <button class="btn-p" onclick="showToast('Preview functionality coming soon','info')">Preview & Apply</button>
    </div>
    <div class="card">
      <div class="sect-hd"><h3>Shopify Sync</h3></div>
      <p class="tx2 fs-13 mb-8">Connect your Shopify store to sync inventory automatically.</p>
      <div class="row-between mb-8">
        <span class="tx2 fs-13">Status</span>
        <span class="chip chip-out">Not connected</span>
      </div>
      <button class="btn-p" onclick="showToast('Shopify integration coming soon','info')">Connect Shopify</button>
    </div>
  </div>
</div>

<!-- s-settings: Settings -->
<div id="s-settings" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Settings</h1>
  </div>
  <div class="body">
    <div class="card">
      <div class="sect-hd">
        <h3>Option Sets</h3>
        <button class="btn-sm" onclick="openNewOptionSet()">+ New</button>
      </div>
      <div id="option-sets-list"></div>
    </div>
  </div>
</div>

<!-- ============ BOTTOM SHEETS ============ -->

<!-- sh-nav: Navigation Drawer -->
<div id="sh-nav" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-nav')">
  <div class="sh" style="border-radius:0;width:300px;margin-left:auto;height:100dvh;max-height:100dvh;">
    <div style="padding:24px 16px 16px;">
      <div class="nav-logo">BoutiqBiz</div>
      <div class="nav-store">Demo Store</div>
    </div>
    <div style="padding:0 8px;">
      <div class="nav-item" onclick="showScreen('s-list');closeSheet('sh-nav')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
        <span class="nav-item-label">Materials</span>
      </div>
      <div class="nav-item" onclick="initMatIn();showScreen('s-mat-in');closeSheet('sh-nav')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        <span class="nav-item-label">Material In</span>
      </div>
      <div class="nav-item" onclick="initMatOut();showScreen('s-mat-out');closeSheet('sh-nav')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
        <span class="nav-item-label">Material Out</span>
      </div>
      <div class="nav-item" onclick="renderCollections();showScreen('s-collections');closeSheet('sh-nav')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        <span class="nav-item-label">Collections</span>
      </div>
      <div class="nav-item" onclick="renderOrderRequests('all');showScreen('s-order-requests');closeSheet('sh-nav')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <span class="nav-item-label">Client Order Requests</span>
      </div>
      <div class="nav-item" onclick="renderLabels();showScreen('s-labels');closeSheet('sh-nav')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
        <span class="nav-item-label">Print Labels</span>
      </div>
      <div class="nav-item" onclick="showScreen('s-sync');closeSheet('sh-nav')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><polyline points="23 20 23 14 17 14"/><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"/></svg>
        <span class="nav-item-label">Sync Inventory</span>
      </div>
      <div class="nav-item" onclick="renderOptionSets();showScreen('s-settings');closeSheet('sh-nav')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93A10 10 0 0 1 21 12a10 10 0 0 1-1.93 7.07M4.93 4.93A10 10 0 0 0 3 12a10 10 0 0 0 1.93 7.07M12 2v2m0 16v2M2 12h2m16 0h2"/></svg>
        <span class="nav-item-label">Settings</span>
      </div>
    </div>
  </div>
</div>

<!-- sh-filter: Filter -->
<div id="sh-filter" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-filter')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd">
      <h3>Filter</h3>
      <button class="btn-ghost" onclick="closeSheet('sh-filter')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <div class="sh-body">
      <label style="margin-bottom:8px;display:block;">Type</label>
      <div class="filter-opt"><input type="radio" name="fil-type" value="" checked onchange="window._tmpFilter=window._tmpFilter||{};window._tmpFilter.type=''"> <span>All</span></div>
      <div class="filter-opt"><input type="radio" name="fil-type" value="finished" onchange="window._tmpFilter=window._tmpFilter||{};window._tmpFilter.type='finished'"> <span>Finished</span></div>
      <div class="filter-opt"><input type="radio" name="fil-type" value="raw" onchange="window._tmpFilter=window._tmpFilter||{};window._tmpFilter.type='raw'"> <span>Raw</span></div>
      <div class="filter-opt"><input type="radio" name="fil-type" value="production" onchange="window._tmpFilter=window._tmpFilter||{};window._tmpFilter.type='production'"> <span>Production</span></div>
      <div class="divider"></div>
      <label style="margin-bottom:8px;display:block;">Stock Status</label>
      <div class="filter-opt"><input type="radio" name="fil-stock" value="" checked onchange="window._tmpFilter=window._tmpFilter||{};window._tmpFilter.stockStatus=''"> <span>Any</span></div>
      <div class="filter-opt"><input type="radio" name="fil-stock" value="ok" onchange="window._tmpFilter=window._tmpFilter||{};window._tmpFilter.stockStatus='ok'"> <span>In Stock</span></div>
      <div class="filter-opt"><input type="radio" name="fil-stock" value="low" onchange="window._tmpFilter=window._tmpFilter||{};window._tmpFilter.stockStatus='low'"> <span>Low Stock</span></div>
      <div class="filter-opt"><input type="radio" name="fil-stock" value="out" onchange="window._tmpFilter=window._tmpFilter||{};window._tmpFilter.stockStatus='out'"> <span>Out of Stock</span></div>
      <div class="divider"></div>
      <div class="fld">
        <label>Vendor</label>
        <input type="text" id="fil-vendor" placeholder="Vendor name">
      </div>
    </div>
    <div class="sh-footer">
      <button class="btn-s flex-1" onclick="clearFilter()">Clear</button>
      <button class="btn-p flex-1" onclick="applyFilter()">Apply</button>
    </div>
  </div>
</div>

<!-- sh-sort: Sort -->
<div id="sh-sort" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-sort')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Sort By</h3><button class="btn-ghost" onclick="closeSheet('sh-sort')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="sort-opt" onclick="applySort('name','asc')"><span>Name A–Z</span><span id="so-na" class="txp" style="display:none;">✓</span></div>
      <div class="sort-opt" onclick="applySort('name','desc')"><span>Name Z–A</span><span id="so-nd" class="txp" style="display:none;">✓</span></div>
      <div class="sort-opt" onclick="applySort('stock','desc')"><span>Stock High–Low</span><span id="so-sh" class="txp" style="display:none;">✓</span></div>
      <div class="sort-opt" onclick="applySort('stock','asc')"><span>Stock Low–High</span><span id="so-sl" class="txp" style="display:none;">✓</span></div>
    </div>
  </div>
</div>

<!-- sh-cols: Column Toggle -->
<div id="sh-cols" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-cols')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Columns</h3><button class="btn-ghost" onclick="closeSheet('sh-cols')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body" id="sh-cols-body"></div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="applyColumns()">Apply</button></div>
  </div>
</div>

<!-- sh-saveview: Save View -->
<div id="sh-saveview" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-saveview')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Save View</h3><button class="btn-ghost" onclick="closeSheet('sh-saveview')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="fld"><label>View Name</label><input type="text" id="saveview-name" placeholder="My custom view"></div>
      <p class="tx2 fs-12">This will save your current filters, columns, and sort order as a named view.</p>
    </div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="doSaveView()">Save View</button></div>
  </div>
</div>

<!-- sh-move: Record Movement -->
<div id="sh-move" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-move')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Record Movement</h3><button class="btn-ghost" onclick="closeSheet('sh-move')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="fld"><label>Type</label>
        <select id="mv-type">
          <option value="Stock in">Stock in</option>
          <option value="Stock out">Stock out</option>
          <option value="Transfer">Transfer</option>
          <option value="Adjustment">Adjustment</option>
        </select>
      </div>
      <div class="fld"><label>Quantity</label><input type="number" id="mv-qty" min="0" placeholder="0"></div>
      <div class="fld"><label>Rate (optional)</label><input type="number" id="mv-rate" min="0" placeholder="₹0"></div>
      <div class="fld"><label>Reference</label><input type="text" id="mv-ref" placeholder="INV-001 / Order ref"></div>
      <div class="fld"><label>Note</label><textarea id="mv-note" rows="2" placeholder="Optional note"></textarea></div>
      <div class="fld"><label>Date</label><input type="date" id="mv-date"></div>
    </div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="doRecordMovement()">Save</button></div>
  </div>
</div>

<!-- sh-stockcount: Stock Count -->
<div id="sh-stockcount" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-stockcount')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3 id="sc-title">Stock Count</h3><button class="btn-ghost" onclick="closeSheet('sh-stockcount')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="note mb-8" id="sc-system">System qty: loading…</div>
      <div class="fld"><label>Physical Count</label><input type="number" id="sc-physical" min="0" placeholder="0" oninput="calcStockDiff()"></div>
      <div id="sc-diff" style="display:none;" class="note mt-8"></div>
    </div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="doStockCountConfirm()">Confirm Count</button></div>
  </div>
</div>

<!-- sh-reserve: Add Reservation -->
<div id="sh-reserve" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-reserve')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Add Reservation</h3><button class="btn-ghost" onclick="closeSheet('sh-reserve')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="fld"><label>Order Ref</label><input type="text" id="rv-ref" placeholder="ORD-001"></div>
      <div class="fld"><label>Customer Name</label><input type="text" id="rv-customer" placeholder="Customer name"></div>
      <div class="fld"><label>Quantity</label><input type="number" id="rv-qty" min="1" placeholder="1"></div>
      <div class="fld"><label>Date</label><input type="date" id="rv-date"></div>
    </div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="doAddReservation()">Add Reservation</button></div>
  </div>
</div>

<!-- sh-labeldesign: Label Design Editor -->
<div id="sh-labeldesign" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-labeldesign')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3 id="ld-sheet-title">New Label Design</h3><button class="btn-ghost" onclick="closeSheet('sh-labeldesign')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="fld"><label>Design Name</label><input type="text" id="ld-name" placeholder="e.g. Standard Price Tag"></div>
      <div class="fld"><label>Size</label>
        <select id="ld-size">
          <option value="50x25mm">50×25mm</option>
          <option value="38x25mm">38×25mm</option>
          <option value="100x50mm">100×50mm</option>
          <option value="custom">Custom</option>
        </select>
      </div>
      <div class="fld"><label>Fields to show</label>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px;">
          <label class="filter-opt"><input type="checkbox" id="ldf-name" checked> Product name</label>
          <label class="filter-opt"><input type="checkbox" id="ldf-variant" checked> Variant</label>
          <label class="filter-opt"><input type="checkbox" id="ldf-mrp" checked> MRP</label>
          <label class="filter-opt"><input type="checkbox" id="ldf-offer" checked> Offer price</label>
          <label class="filter-opt"><input type="checkbox" id="ldf-sku"> SKU</label>
          <label class="filter-opt"><input type="checkbox" id="ldf-barcode"> Barcode</label>
          <label class="filter-opt"><input type="checkbox" id="ldf-designno"> Design No.</label>
          <label class="filter-opt"><input type="checkbox" id="ldf-logo"> Logo</label>
        </div>
      </div>
    </div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="doSaveLabelDesign()">Save Design</button></div>
  </div>
</div>

<!-- sh-addlabel: Add to Queue -->
<div id="sh-addlabel" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-addlabel')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Add to Print Queue</h3><button class="btn-ghost" onclick="closeSheet('sh-addlabel')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="note mb-8" id="al-matinfo"></div>
      <div class="fld"><label>Select Design</label><div id="al-designs"></div></div>
      <div class="fld"><label>Quantity</label>
        <div class="row gap-8">
          <button class="icon-btn" onclick="alQtyAdj(-1)"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/></svg></button>
          <input type="number" id="al-qty" value="1" min="1" style="text-align:center;">
          <button class="icon-btn" onclick="alQtyAdj(1)"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></button>
        </div>
      </div>
    </div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="doAddToQueue()">Add to Queue</button></div>
  </div>
</div>

<!-- sh-matitem: Material/Item Picker -->
<div id="sh-matitem" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-matitem')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Select Material</h3><button class="btn-ghost" onclick="closeSheet('sh-matitem')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="fld"><input type="search" id="matpick-search" placeholder="Search materials…" oninput="renderMatPicker()"></div>
      <div id="matpick-list" style="max-height:50dvh;overflow-y:auto;"></div>
    </div>
  </div>
</div>

<!-- sh-bomline: BOM Line Editor -->
<div id="sh-bomline" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-bomline')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3 id="bl-title">Add BOM Line</h3><button class="btn-ghost" onclick="closeSheet('sh-bomline')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="fld">
        <label>Raw Material</label>
        <select id="bl-mat" onchange="renderBLVariants()">
          <option value="">Select material…</option>
        </select>
      </div>
      <div class="fld" id="bl-var-row" style="display:none;">
        <label>Variant (optional)</label>
        <select id="bl-var"><option value="">Any variant</option></select>
      </div>
      <div class="fld">
        <label>Quantity</label>
        <div class="row gap-8">
          <input type="number" id="bl-qty" placeholder="1.0" min="0" step="0.01" style="flex:1;">
          <select id="bl-unit" style="width:120px;">
            <option>metres</option><option>kg</option><option>pcs</option><option>sets</option><option>litres</option><option>other</option>
          </select>
        </div>
      </div>
      <div class="fld"><label>Note</label><input type="text" id="bl-note" placeholder="Optional note"></div>
    </div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="doSaveBOMLine()">Save Line</button></div>
  </div>
</div>

<!-- sh-sharelink: Preview Link Settings -->
<div id="sh-sharelink" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-sharelink')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Preview Link</h3><button class="btn-ghost" onclick="closeSheet('sh-sharelink')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="toggle-row mb-12">
        <span class="fw-6">Enable preview link</span>
        <label class="toggle"><input type="checkbox" id="sl-toggle" onchange="togglePreviewLink(window._cdColId)"><span class="toggle-slider"></span></label>
      </div>
      <div class="fld"><label>Preview URL</label>
        <div class="row gap-8">
          <input type="text" id="sl-url" readonly style="flex:1;">
          <button class="btn-sm" onclick="copyPreviewLink()">Copy</button>
        </div>
      </div>
      <div class="fld"><label>Expires</label><input type="date" id="sl-expiry"></div>
    </div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="saveShareLink()">Save Settings</button></div>
  </div>
</div>

<!-- sh-applyall: Apply to All Variants -->
<div id="sh-applyall" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-applyall')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Apply to All Variants</h3><button class="btn-ghost" onclick="closeSheet('sh-applyall')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <label class="col-opt"><input type="checkbox" id="aa-pricing"> <span>Pricing (MRP / Offer / Cost)</span></label>
      <label class="col-opt"><input type="checkbox" id="aa-images"> <span>Images</span></label>
      <label class="col-opt"><input type="checkbox" id="aa-stock"> <span>Opening stock</span></label>
      <label class="col-opt"><input type="checkbox" id="aa-barcodes"> <span>Barcodes</span></label>
    </div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="doApplyAll()">Apply Selected</button></div>
  </div>
</div>

<!-- sh-newcol: New/Edit Collection -->
<div id="sh-newcol" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-newcol')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3 id="nc-title">New Collection</h3><button class="btn-ghost" onclick="closeSheet('sh-newcol')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="fld"><label>Name</label><input type="text" id="nc-name" placeholder="Collection name"></div>
      <div class="fld"><label>Description</label><textarea id="nc-desc" rows="2" placeholder="Optional description"></textarea></div>
      <div class="fld"><label>Colour</label>
        <div class="color-swatches">
          <div class="color-swatch sel" style="background:#4A3BB5;" onclick="selectColColor('#4A3BB5',this)"></div>
          <div class="color-swatch" style="background:#E24B4A;" onclick="selectColColor('#E24B4A',this)"></div>
          <div class="color-swatch" style="background:#1D9E75;" onclick="selectColColor('#1D9E75',this)"></div>
          <div class="color-swatch" style="background:#BA7517;" onclick="selectColColor('#BA7517',this)"></div>
          <div class="color-swatch" style="background:#185FA5;" onclick="selectColColor('#185FA5',this)"></div>
          <div class="color-swatch" style="background:#6B6494;" onclick="selectColColor('#6B6494',this)"></div>
        </div>
      </div>
    </div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="doSaveCollection()">Save Collection</button></div>
  </div>
</div>

<!-- sh-request-detail: Request Detail -->
<div id="sh-request-detail" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-request-detail')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Order Request</h3><button class="btn-ghost" onclick="closeSheet('sh-request-detail')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body" id="req-detail-body"></div>
    <div class="sh-footer" id="req-detail-actions" style="flex-wrap:wrap;"></div>
  </div>
</div>

<!-- sh-optset: Option Set Editor -->
<div id="sh-optset" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-optset')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3 id="os-title">New Option Set</h3><button class="btn-ghost" onclick="closeSheet('sh-optset')"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="sh-body">
      <div class="fld"><label>Name</label><input type="text" id="os-name" placeholder="e.g. Size"></div>
      <div class="fld"><label>Values (comma-separated)</label><input type="text" id="os-vals" placeholder="XS, S, M, L, XL"></div>
    </div>
    <div class="sh-footer"><button class="btn-p flex-1" onclick="doSaveOptionSet()">Save</button></div>
  </div>
</div>

<!-- Toast -->
<div id="toast" style="position:fixed;bottom:24px;left:50%;transform:translateX(-50%);background:#1D9E75;color:#fff;padding:10px 18px;border-radius:24px;font-size:14px;z-index:9999;display:none;white-space:nowrap;box-shadow:0 4px 20px rgba(0,0,0,0.3);pointer-events:none;"></div>

<script>
// ==================== DATA ====================
var materials = [];
var savedViews = [
  {id:'v-all',name:'All',isSystem:true,filters:{},columns:['name','sku','type','variants','stock'],sort:{field:'name',dir:'asc'},viewMode:'list'},
  {id:'v-low',name:'Low Stock',isSystem:true,filters:{stockStatus:'low'},columns:['name','sku','stock','minqty'],sort:{field:'name',dir:'asc'},viewMode:'list'},
  {id:'v-out',name:'Out of Stock',isSystem:true,filters:{stockStatus:'out'},columns:['name','sku','stock'],sort:{field:'name',dir:'asc'},viewMode:'list'},
  {id:'v-fin',name:'Finished',isSystem:true,filters:{type:'finished'},columns:['name','sku','variants','stock','mrp'],sort:{field:'name',dir:'asc'},viewMode:'list'},
  {id:'v-raw',name:'Raw',isSystem:true,filters:{type:'raw'},columns:['name','sku','variants','stock','unit'],sort:{field:'name',dir:'asc'},viewMode:'list'},
  {id:'v-pro',name:'Production',isSystem:true,filters:{type:'production'},columns:['name','sku','variants','stock'],sort:{field:'name',dir:'asc'},viewMode:'list'},
];
var activeViewId = 'v-all';
var labelDesigns = [];
var labelClients = [];
var labelQueue = [];
var collections = [];
var orderRequests = [];
var optionSets = [
  {id:'os-1',name:'Size',values:['XS','S','M','L','XL','XXL']},
  {id:'os-2',name:'Colour',values:['Red','Blue','Green','Black','White']},
];
var matInEntries = [];
var matOutEntries = [];
var _screenHistory = ['s-list'];
var _editingMatId = null;
var _currentColColor = '#4A3BB5';
var _editingColId = null;
var _editingOsId = null;
var _matItemCallback = null;
var _bomContext = null; // {matId, vi, isProductLevel}
var _tmpFilter = {};

materials = [
  {id:1,name:'Cotton Kurta',type:'finished',sku:'CK-001',designNo:'D-001',unit:'pcs',
   vendors:[{name:'Ravi Textiles',type:'supplier',lead:'7 days',contact:'9876543210'}],
   imgs:[],desc:'Premium cotton kurta for women',notes:'',techpackUrl:'',techpackFile:'',externalLinks:[],
   bom:[{id:'b1',materialId:2,materialName:'Cotton Fabric',variantIdx:null,qty:1.2,unit:'metres',note:'',isVariantOverride:false}],
   cats:[{name:'Size',values:['S','M','L','XL']},{name:'Colour',values:['Red','Blue']}],
   collections:[],
   variants:[
     {name:'S / Red',sku:'CK-001-SR',mrp:1200,offer:999,cost:400,qty:15,barcode:'',minqty:5,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],
      bomOverrides:[{id:'bo1',materialId:2,materialName:'Cotton Fabric',variantIdx:null,qty:1.0,unit:'metres',note:'S size',isVariantOverride:true}],
      reservations:[],movements:[{date:'2024-01-15',type:'Stock in',subtype:'Purchase',qty:20,rate:400,ref:'INV-001',note:'Opening stock'}],
      inventory:{stores:[{loc:'VB Asansol',qty:10,color:'#4A3BB5'},{loc:'VB Durgapur',qty:5,color:'#1D9E75'}],jobbers:[],production:[],warehouse:[]}},
     {name:'M / Red',sku:'CK-001-MR',mrp:1200,offer:999,cost:420,qty:8,barcode:'',minqty:5,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],
      bomOverrides:[],reservations:[],movements:[],
      inventory:{stores:[{loc:'VB Asansol',qty:8,color:'#4A3BB5'}],jobbers:[],production:[],warehouse:[]}},
     {name:'L / Blue',sku:'CK-001-LB',mrp:1200,offer:999,cost:440,qty:3,barcode:'',minqty:5,color:'#185FA5',tags:[],images:[],notes:'',costLines:[],
      bomOverrides:[],reservations:[],movements:[],
      inventory:{stores:[{loc:'VB Asansol',qty:3,color:'#4A3BB5'}],jobbers:[],production:[],warehouse:[]}},
   ]},
  {id:2,name:'Cotton Fabric',type:'raw',sku:'CF-001',designNo:'',unit:'metres',
   vendors:[{name:'Ravi Textiles',type:'supplier',lead:'3 days',contact:'9876543210'}],
   imgs:[],desc:'100% cotton fabric',notes:'',techpackUrl:'',techpackFile:'',externalLinks:[],
   bom:[],cats:[{name:'Colour',values:['Red','Blue','White']}],collections:[],
   variants:[
     {name:'Red',sku:'CF-001-R',mrp:0,offer:0,cost:120,qty:45,barcode:'',minqty:10,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],
      bomOverrides:[],reservations:[],
      movements:[{date:'2024-01-10',type:'Stock in',subtype:'Purchase',qty:50,rate:120,ref:'INV-002',note:''}],
      inventory:{stores:[],jobbers:[],production:[{loc:'Main Store',qty:45,color:'#4A3BB5'}],warehouse:[]}},
     {name:'Blue',sku:'CF-001-B',mrp:0,offer:0,cost:120,qty:2,barcode:'',minqty:10,color:'#185FA5',tags:[],images:[],notes:'',costLines:[],
      bomOverrides:[],reservations:[],movements:[],
      inventory:{stores:[],jobbers:[],production:[{loc:'Main Store',qty:2,color:'#4A3BB5'}],warehouse:[]}},
   ]},
];

// ==================== UTILS ====================
function uuid(){return 'id-'+Math.random().toString(36).substr(2,9);}
function todayStr(){var d=new Date();return d.toISOString().split('T')[0];}
function fmtQty(qty,unit){return qty+(unit?' '+unit:'');}
function fmtCurr(n){return '₹'+Number(n||0).toLocaleString('en-IN');}
function totalStock(m){return m.variants.reduce(function(s,v){return s+v.qty;},0);}
function stockStatus(v){if(v.qty<=0)return 'out';if(v.minqty>0&&v.qty<=v.minqty)return 'low';return 'ok';}
function statusColor(s){if(s==='out')return 'var(--r)';if(s==='low')return 'var(--a)';return 'var(--g)';}
function statusChipClass(s){if(s==='out')return 'chip-out';if(s==='low')return 'chip-low';return 'chip-ok';}
function typeChipClass(t){if(t==='finished')return 'chip-f';if(t==='raw')return 'chip-r';return 'chip-p';}
function typeLabel(t){if(t==='finished')return 'F';if(t==='raw')return 'R';return 'P';}
function nextId(arr){return arr.length?Math.max.apply(null,arr.map(function(x){return x.id||0;}))+1:1;}
function getMat(id){return materials.find(function(m){return m.id===id;});}
function showToast(msg,type){
  var t=document.getElementById('toast');
  t.textContent=msg;
  t.style.background=type==='error'?'#E24B4A':type==='info'?'#185FA5':'#1D9E75';
  t.style.display='block';
  clearTimeout(window._toastTimer);
  window._toastTimer=setTimeout(function(){t.style.display='none';},2400);
}
function esc(s){return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');}

// ==================== NAVIGATION ====================
function showScreen(id){
  document.querySelectorAll('.screen').forEach(function(s){s.classList.remove('on');});
  var el=document.getElementById(id);
  if(el){el.classList.add('on');window.scrollTo(0,0);}
  if(_screenHistory[_screenHistory.length-1]!==id)_screenHistory.push(id);
}
function pushScreen(id){showScreen(id);}
function goBack(){
  _screenHistory.pop();
  var prev=_screenHistory[_screenHistory.length-1]||'s-list';
  document.querySelectorAll('.screen').forEach(function(s){s.classList.remove('on');});
  var el=document.getElementById(prev);
  if(el){el.classList.add('on');window.scrollTo(0,0);}
}
function openSheet(id){document.getElementById(id).classList.add('open');}
function closeSheet(id){document.getElementById(id).classList.remove('open');}
function closeAllSheets(){document.querySelectorAll('.sh-ov').forEach(function(s){s.classList.remove('open');});}

// ==================== MATERIAL LIST ====================
function renderViewsBar(){
  var inner=document.getElementById('views-inner');
  var html='';
  savedViews.forEach(function(v){
    html+='<button class="view-pill'+(v.id===activeViewId?' on':'')+'" onclick="setActiveView(\''+v.id+'\')" '+(v.isSystem?'':'oncontextmenu="event.preventDefault();showViewMenu(\''+v.id+'\')"')+'>'+esc(v.name)+'</button>';
  });
  html+='<button class="view-pill-new" onclick="openSheet(\'sh-saveview\')">+ New view</button>';
  inner.innerHTML=html;
}
function setActiveView(id){
  activeViewId=id;
  renderViewsBar();
  renderList();
}
function getFilteredMaterials(){
  var view=savedViews.find(function(v){return v.id===activeViewId;})||savedViews[0];
  var f=view.filters||{};
  var q=(document.getElementById('list-search')||{}).value||'';
  q=q.toLowerCase();
  return materials.filter(function(m){
    if(f.type&&m.type!==f.type)return false;
    if(f.stockStatus){
      var st=totalStock(m);
      var minq=Math.max.apply(null,m.variants.map(function(v){return v.minqty||0;}));
      if(f.stockStatus==='out'&&st>0)return false;
      if(f.stockStatus==='low'&&(st<=0||st>minq))return false;
      if(f.stockStatus==='ok'&&(st<=0||(minq>0&&st<=minq)))return false;
    }
    if(f.vendor&&m.vendors&&!m.vendors.some(function(v){return v.name.toLowerCase().includes(f.vendor.toLowerCase());}))return false;
    if(q&&!m.name.toLowerCase().includes(q)&&!m.sku.toLowerCase().includes(q))return false;
    return true;
  });
}
function getSortedMaterials(arr){
  var view=savedViews.find(function(v){return v.id===activeViewId;})||savedViews[0];
  var s=view.sort||{field:'name',dir:'asc'};
  return arr.slice().sort(function(a,b){
    var av=s.field==='stock'?totalStock(a):(a[s.field]||'').toString().toLowerCase();
    var bv=s.field==='stock'?totalStock(b):(b[s.field]||'').toString().toLowerCase();
    if(av<bv)return s.dir==='asc'?-1:1;
    if(av>bv)return s.dir==='asc'?1:-1;
    return 0;
  });
}
function renderList(){
  var filtered=getFilteredMaterials();
  var sorted=getSortedMaterials(filtered);
  var varCount=sorted.reduce(function(s,m){return s+m.variants.length;},0);
  document.getElementById('list-meta').textContent=sorted.length+' items · '+varCount+' variants';
  var wrap=document.getElementById('list-wrap');
  if(!sorted.length){
    wrap.innerHTML='<div class="empty-state"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg><div>No materials match this view</div></div>';
    return;
  }
  var html='';
  sorted.forEach(function(m){
    var ts=totalStock(m);
    var st=ts<=0?'out':(m.variants.some(function(v){return v.minqty>0&&v.qty<=v.minqty;}))?'low':'ok';
    html+='<div class="mat-row" onclick="openMDetail('+m.id+')">';
    html+='<span class="chip '+typeChipClass(m.type)+'" style="font-size:11px;padding:2px 7px;">'+typeLabel(m.type)+'</span>';
    html+='<div class="mat-info"><div class="mat-name">'+esc(m.name)+'</div><div class="mat-sku">'+esc(m.sku)+'</div></div>';
    html+='<div class="mat-right"><div class="text-center"><div class="mat-qty">'+ts+'</div><div class="mat-unit">'+esc(m.unit)+'</div></div>';
    html+='<span class="dot dot-'+st+'"></span>';
    html+='<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--tx3)"><polyline points="9 18 15 12 9 6"/></svg>';
    html+='</div></div>';
  });
  wrap.innerHTML=html;
}
function applySort(field,dir){
  var view=savedViews.find(function(v){return v.id===activeViewId;});
  if(view){view.sort={field:field,dir:dir};}
  closeSheet('sh-sort');
  renderList();
}
function clearFilter(){
  var view=savedViews.find(function(v){return v.id===activeViewId;});
  if(view)view.filters={};
  _tmpFilter={};
  closeSheet('sh-filter');
  renderList();
}
function applyFilter(){
  var view=savedViews.find(function(v){return v.id===activeViewId;});
  if(view){
    var t=document.querySelector('input[name="fil-type"]:checked');
    var s=document.querySelector('input[name="fil-stock"]:checked');
    var vendor=document.getElementById('fil-vendor').value;
    view.filters={};
    if(t&&t.value)view.filters.type=t.value;
    if(s&&s.value)view.filters.stockStatus=s.value;
    if(vendor)view.filters.vendor=vendor;
  }
  closeSheet('sh-filter');
  renderList();
}
function doSaveView(){
  var name=document.getElementById('saveview-name').value.trim();
  if(!name){showToast('Enter a view name','error');return;}
  var view=savedViews.find(function(v){return v.id===activeViewId;});
  var filters=view?Object.assign({},view.filters):{};
  var sort=view?Object.assign({},view.sort):{field:'name',dir:'asc'};
  var cols=view?view.columns.slice():['name','sku','type','stock'];
  savedViews.push({id:uuid(),name:name,isSystem:false,filters:filters,columns:cols,sort:sort,viewMode:'list'});
  document.getElementById('saveview-name').value='';
  closeSheet('sh-saveview');
  renderViewsBar();
  showToast('View saved');
}
function showViewMenu(id){
  var v=savedViews.find(function(x){return x.id===id;});
  if(!v||v.isSystem)return;
  if(confirm('Delete view "'+v.name+'"?')){
    savedViews=savedViews.filter(function(x){return x.id!==id;});
    if(activeViewId===id)activeViewId='v-all';
    renderViewsBar();
    renderList();
    showToast('View deleted');
  }
}
function renderColsSheet(){
  var allCols=['name','sku','type','variants','stock','mrp','offer','cost','unit','minqty','vendor'];
  var view=savedViews.find(function(v){return v.id===activeViewId;})||savedViews[0];
  var active=view.columns||[];
  var html='';
  allCols.forEach(function(c){
    var labels={name:'Name',sku:'SKU',type:'Type',variants:'Variants',stock:'Stock qty',mrp:'MRP',offer:'Offer price',cost:'Cost',unit:'Unit',minqty:'Min qty',vendor:'Vendor'};
    html+='<label class="col-opt"><input type="checkbox" value="'+c+'" '+(active.indexOf(c)>=0?'checked':'')+'>'+labels[c]+'</label>';
  });
  document.getElementById('sh-cols-body').innerHTML=html;
}
function applyColumns(){
  var checks=document.querySelectorAll('#sh-cols-body input:checked');
  var cols=[];
  checks.forEach(function(c){cols.push(c.value);});
  var view=savedViews.find(function(v){return v.id===activeViewId;});
  if(view)view.columns=cols;
  closeSheet('sh-cols');
  renderList();
}

// ==================== CREATE/EDIT MATERIAL ====================
function openCreate(matId){
  _editingMatId=matId||null;
  var m=matId?getMat(matId):null;
  document.getElementById('create-title').textContent=m?m.name:'New Material';
  setCTab(0);
  var info=document.getElementById('c-tab-info');
  info.innerHTML=buildInfoHTML(m);
  showScreen('s-create');
}
function setCTab(n){
  var tabs=document.querySelectorAll('#s-create .tab');
  tabs.forEach(function(t,i){t.classList.toggle('on',i===n);});
  document.getElementById('c-tab-info').style.display=n===0?'flex':'none';
  document.getElementById('c-tab-variants').style.display=n===1?'flex':'none';
  document.getElementById('c-tab-movement').style.display=n===2?'flex':'none';
  if(n===1){var m=_editingMatId?getMat(_editingMatId):null;document.getElementById('c-tab-variants').innerHTML=buildVariantsHTML(m);}
  if(n===2){var m2=_editingMatId?getMat(_editingMatId):null;document.getElementById('c-tab-movement').innerHTML=buildMovementHTML(m2);}
}
function buildInfoHTML(m){
  var html='';
  html+='<div class="card"><div class="fld"><label>Name</label><input type="text" id="ci-name" value="'+esc(m?m.name:'')+'" placeholder="Material name" oninput="autoSku()"></div>';
  html+='<div class="fld"><label>SKU</label><input type="text" id="ci-sku" value="'+esc(m?m.sku:'')+'" placeholder="CK-001"></div>';
  html+='<div class="fld"><label>Design No.</label><input type="text" id="ci-designno" value="'+esc(m?m.designNo:'')+'" placeholder="D-001"></div>';
  html+='<div class="fld"><label>Type</label><select id="ci-type" onchange="toggleBOMSection()"><option value="finished"'+((!m||m.type==='finished')?' selected':'')+'>Finished</option><option value="raw"'+(m&&m.type==='raw'?' selected':'')+'>Raw</option><option value="production"'+(m&&m.type==='production'?' selected':'')+'>Production</option></select></div>';
  html+='<div class="fld"><label>Unit</label><input type="text" id="ci-unit" value="'+esc(m?m.unit:'')+'" placeholder="pcs / metres / kg"></div>';
  html+='<div class="fld"><label>Description</label><textarea id="ci-desc" rows="2">'+esc(m?m.desc:'')+'</textarea></div>';
  html+='<div class="fld"><label>Notes</label><textarea id="ci-notes" rows="2">'+esc(m?m.notes:'')+'</textarea></div></div>';
  // Vendor
  html+='<div class="card"><div class="sect-hd"><h3>Vendors</h3><button class="btn-sm" onclick="addVendorRow()">+ Add vendor</button></div><div id="ci-vendors">';
  var vendors=m?m.vendors:[];
  vendors.forEach(function(v,i){
    html+='<div class="vendor-row"><div class="vendor-info"><div class="fw-6 fs-13">'+esc(v.name)+'</div><div class="tx2 fs-12">'+esc(v.type)+' · Lead: '+esc(v.lead)+'</div></div><button class="btn-ghost" onclick="removeVendorRow('+i+')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>';
  });
  html+='</div></div>';
  // Global pricing
  html+='<div class="card"><div class="sect-hd"><h3>Pricing</h3><button class="btn-sm" onclick="copyGlobalPricingUI()">Copy to all variants</button></div>';
  html+='<div class="grid-2"><div class="fld"><label>MRP</label><input type="number" id="ci-mrp" value="'+(m&&m.variants.length?m.variants[0].mrp:'')+'" placeholder="0"></div>';
  html+='<div class="fld"><label>Offer</label><input type="number" id="ci-offer" value="'+(m&&m.variants.length?m.variants[0].offer:'')+'" placeholder="0"></div>';
  html+='<div class="fld"><label>Cost</label><input type="number" id="ci-cost" value="'+(m&&m.variants.length?m.variants[0].cost:'')+'" placeholder="0"></div></div></div>';
  // BOM section
  var showBOM=!m||(m.type==='finished'||m.type==='production');
  html+='<div class="card" id="ci-bom-section" style="display:'+(showBOM?'block':'none')+'">';
  html+='<div class="sect-hd"><h3>Bill of Materials</h3><button class="btn-sm" onclick="openBOMLineSheet(null,null,true)">+ Add line</button></div>';
  html+='<div id="ci-bom-list">';
  var bom=m?m.bom:[];
  if(bom.length){
    bom.forEach(function(line,i){
      html+='<div class="bom-row"><div class="bom-info"><div class="bom-mat">'+esc(line.materialName)+'</div><div class="bom-note">'+esc(line.note||'')+'</div></div>';
      html+='<div class="bom-qty">'+line.qty+' '+esc(line.unit)+'</div>';
      html+='<button class="btn-ghost" onclick="removeProdBOMLine('+i+')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>';
    });
  } else {html+='<div class="tx3 fs-12 text-center" style="padding:16px;">No BOM lines yet</div>';}
  html+='</div></div>';
  // Variant categories
  html+='<div class="card"><div class="sect-hd"><h3>Variant Categories</h3>';
  html+='<select id="ci-preset" style="width:auto;" onchange="addPresetCat()"><option value="">Add preset…</option>';
  optionSets.forEach(function(os){html+='<option value="'+esc(os.id)+'">'+esc(os.name)+'</option>';});
  html+='</select></div><div id="ci-cats">';
  var cats=m?m.cats:[];
  cats.forEach(function(cat,i){
    html+='<div class="var-row" style="flex-wrap:wrap;"><div style="flex:1;"><span class="fw-6 fs-13">'+esc(cat.name)+'</span><div style="display:flex;flex-wrap:wrap;gap:4px;margin-top:6px;">';
    cat.values.forEach(function(v){html+='<span class="chip" style="background:var(--pl);color:var(--pt);font-size:11px;">'+esc(v)+'</span>';});
    html+='</div></div><button class="btn-ghost" onclick="removeCat('+i+')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>';
  });
  html+='</div>';
  html+='<div style="display:flex;gap:8px;margin-top:10px;">';
  html+='<button class="btn-sm" onclick="addCustomCat()">+ Add category</button>';
  html+='<button class="btn-sm" onclick="doGenerateVariants()">Generate combinations</button>';
  html+='</div></div>';
  return html;
}
function autoSku(){
  var name=document.getElementById('ci-name').value;
  var sku=name.split(' ').map(function(w){return w[0]||'';}).join('').toUpperCase()+'-001';
  var skuEl=document.getElementById('ci-sku');
  if(skuEl&&!skuEl._edited)skuEl.value=sku;
}
function toggleBOMSection(){
  var type=document.getElementById('ci-type').value;
  var sec=document.getElementById('ci-bom-section');
  if(sec)sec.style.display=(type==='finished'||type==='production')?'block':'none';
}
var _tmpVendors=[];
var _tmpCats=[];
function addVendorRow(){
  var name=prompt('Vendor name:');if(!name)return;
  _tmpVendors.push({name:name,type:'supplier',lead:'',contact:''});
  var el=_editingMatId?getMat(_editingMatId):null;
  var vlist=document.getElementById('ci-vendors');
  if(vlist){
    vlist.innerHTML+='<div class="vendor-row"><div class="vendor-info"><div class="fw-6 fs-13">'+esc(name)+'</div><div class="tx2 fs-12">supplier</div></div></div>';
  }
}
function removeVendorRow(i){
  var el=_editingMatId?getMat(_editingMatId):null;
  if(el&&el.vendors){el.vendors.splice(i,1);}
  openCreate(_editingMatId);
}
function addCustomCat(){
  var name=prompt('Category name (e.g. Size):');if(!name)return;
  var vals=prompt('Values (comma-separated, e.g. S,M,L,XL):');if(!vals)return;
  var m=_editingMatId?getMat(_editingMatId):null;
  var cat={name:name,values:vals.split(',').map(function(v){return v.trim();}).filter(Boolean)};
  if(m){m.cats.push(cat);}
  else{if(!window._newMatCats)window._newMatCats=[];window._newMatCats.push(cat);}
  setCTab(0);
}
function addPresetCat(){
  var sel=document.getElementById('ci-preset');
  var id=sel.value;if(!id)return;
  var os=optionSets.find(function(o){return o.id===id;});
  if(!os)return;
  var m=_editingMatId?getMat(_editingMatId):null;
  var cat={name:os.name,values:os.values.slice()};
  if(m){m.cats.push(cat);}
  openCreate(_editingMatId);
  sel.value='';
}
function removeCat(i){
  var m=_editingMatId?getMat(_editingMatId):null;
  if(m){m.cats.splice(i,1);}
  openCreate(_editingMatId);
}
function doGenerateVariants(){
  var m=_editingMatId?getMat(_editingMatId):null;
  if(!m){showToast('Save the material first','info');return;}
  generateVariants(m);
  setCTab(1);
  showToast('Variants generated');
}
function generateVariants(m){
  if(!m.cats||!m.cats.length)return;
  var combos=[['']];
  m.cats.forEach(function(cat){
    var newCombos=[];
    combos.forEach(function(combo){
      cat.values.forEach(function(val){
        newCombos.push(combo.concat([val]));
      });
    });
    combos=newCombos;
  });
  combos=combos.filter(function(c){return c.some(function(x){return x;});});
  var existing=m.variants.map(function(v){return v.name;});
  combos.forEach(function(parts){
    var name=parts.filter(Boolean).join(' / ');
    if(existing.indexOf(name)<0){
      m.variants.push({name:name,sku:m.sku+'-'+name.replace(/[^a-zA-Z0-9]/g,'').toUpperCase(),mrp:0,offer:0,cost:0,qty:0,barcode:'',minqty:0,color:'#4A3BB5',tags:[],images:[],notes:'',costLines:[],bomOverrides:[],reservations:[],movements:[],inventory:{stores:[],jobbers:[],production:[],warehouse:[]}});
    }
  });
}
function copyGlobalPricingUI(){
  var m=_editingMatId?getMat(_editingMatId):null;if(!m)return;
  var mrp=parseFloat(document.getElementById('ci-mrp').value)||0;
  var offer=parseFloat(document.getElementById('ci-offer').value)||0;
  var cost=parseFloat(document.getElementById('ci-cost').value)||0;
  m.variants.forEach(function(v){v.mrp=mrp;v.offer=offer;v.cost=cost;});
  showToast('Pricing copied to all variants');
}
function copyGlobalPricing(m){
  m.variants.forEach(function(v){if(!v.mrp&&!v.offer&&!v.cost){v.mrp=m.variants[0].mrp||0;v.offer=m.variants[0].offer||0;v.cost=m.variants[0].cost||0;}});
}
function removeProdBOMLine(i){
  var m=_editingMatId?getMat(_editingMatId):null;if(!m)return;
  m.bom.splice(i,1);
  setCTab(0);
}
function buildVariantsHTML(m){
  if(!m||!m.variants||!m.variants.length)return '<div class="empty-state" style="margin-top:40px;"><svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg><div>No variants yet. Add categories and generate combinations.</div></div>';
  var html='<div class="card"><div class="sect-hd"><h3>'+m.variants.length+' Variants</h3></div>';
  m.variants.forEach(function(v,i){
    var st=stockStatus(v);
    html+='<div class="var-row"><div class="var-swatch" style="background:'+v.color+'"></div>';
    html+='<div class="var-info"><div class="var-name">'+esc(v.name)+'</div><div class="var-sku">'+esc(v.sku)+'</div></div>';
    html+='<span class="tx2 fs-13">'+v.qty+'</span>';
    html+='<div class="var-actions"><button class="btn-sm" onclick="openVDetail('+m.id+','+i+')">Edit →</button>';
    html+='<button class="btn-sm" onclick="openAddLabel('+m.id+','+i+')">🏷</button></div></div>';
  });
  html+='</div>';
  return html;
}
function buildMovementHTML(m){
  if(!m)return '<div class="empty-state"><div>Save the material first to view movements.</div></div>';
  var allMovements=[];
  m.variants.forEach(function(v,vi){
    v.movements.forEach(function(mv){allMovements.push(Object.assign({},mv,{variantName:v.name,vi:vi}));});
  });
  allMovements.sort(function(a,b){return b.date.localeCompare(a.date);});
  var html='<div class="card"><div class="sect-hd"><h3>Movement Log</h3><button class="btn-sm" onclick="openMoveSheet('+m.id+',0)">+ Record</button></div>';
  if(!allMovements.length)return html+'<div class="tx3 text-center" style="padding:20px;">No movements yet</div></div>';
  allMovements.forEach(function(mv){
    var dot=mv.type==='Stock in'?'move-in':mv.type==='Stock out'?'move-out':'move-adj';
    html+='<div class="move-row"><div class="move-dot '+dot+'"></div><div class="move-body"><div class="move-type">'+esc(mv.type)+(mv.subtype?' · '+esc(mv.subtype):'')+'</div><div class="move-sub">'+esc(mv.variantName)+' · '+esc(mv.date)+(mv.ref?' · '+esc(mv.ref):'')+'</div>'+(mv.note?'<div class="tx3 fs-12">'+esc(mv.note)+'</div>':'')+'</div><div class="move-qty" style="color:'+(mv.type==='Stock in'?'var(--g)':'var(--r)')+';">'+(mv.type==='Stock in'?'+':'-')+Math.abs(mv.qty)+'</div></div>';
  });
  html+='</div>';
  return html;
}
function saveCreate(){
  var name=(document.getElementById('ci-name')||{}).value||'';
  if(!name.trim()){showToast('Enter a material name','error');return;}
  var sku=(document.getElementById('ci-sku')||{}).value||'';
  var type=(document.getElementById('ci-type')||{}).value||'finished';
  var unit=(document.getElementById('ci-unit')||{}).value||'pcs';
  var desc=(document.getElementById('ci-desc')||{}).value||'';
  var notes=(document.getElementById('ci-notes')||{}).value||'';
  var designNo=(document.getElementById('ci-designno')||{}).value||'';
  if(_editingMatId){
    var m=getMat(_editingMatId);
    m.name=name;m.sku=sku;m.type=type;m.unit=unit;m.desc=desc;m.notes=notes;m.designNo=designNo;
  } else {
    var newM={id:nextId(materials),name:name,type:type,sku:sku,designNo:designNo,unit:unit,vendors:[],imgs:[],desc:desc,notes:notes,techpackUrl:'',techpackFile:'',externalLinks:[],bom:[],cats:[],collections:[],variants:[]};
    materials.push(newM);
    _editingMatId=newM.id;
  }
  renderList();
  showToast('Material saved');
  goBack();
}

// ==================== VARIANT DETAIL ====================
function openVDetail(matId,vi){
  window._vdMatId=matId;window._vdVi=vi;
  var m=getMat(matId);var v=m.variants[vi];
  document.getElementById('vd-title').textContent=v.name;
  document.getElementById('vd-sub').textContent=m.name+' · '+m.sku;
  setVTab(0);
  showScreen('s-vdetail');
}
function setVTab(n){
  var tabs=document.querySelectorAll('#s-vdetail .tab');
  tabs.forEach(function(t,i){t.classList.toggle('on',i===n);});
  for(var i=0;i<5;i++){var el=document.getElementById('vd-tab-'+i);if(el)el.style.display=i===n?'flex':'none';}
  var m=getMat(window._vdMatId);var vi=window._vdVi;
  if(!m)return;
  var tab=document.getElementById('vd-tab-'+n);
  if(n===0)tab.innerHTML=buildVPricing(m,vi);
  else if(n===1)tab.innerHTML=buildVInventory(m,vi);
  else if(n===2)tab.innerHTML=buildVBOM(m,vi);
  else if(n===3)tab.innerHTML=buildVCosting(m,vi);
  else if(n===4)tab.innerHTML=buildVProduction(m,vi);
}
function buildVPricing(m,vi){
  var v=m.variants[vi];
  var disc=v.mrp>0?Math.round((v.mrp-v.offer)/v.mrp*100):0;
  var margin=v.mrp>0?Math.round((v.offer-v.cost)/v.offer*100):0;
  var html='<div class="card">';
  html+='<div class="grid-2"><div class="fld"><label>MRP</label><input type="number" id="vp-mrp" value="'+v.mrp+'" oninput="calcVPricing()"></div>';
  html+='<div class="fld"><label>Offer Price</label><input type="number" id="vp-offer" value="'+v.offer+'" oninput="calcVPricing()"></div>';
  html+='<div class="fld"><label>Discount %</label><input type="text" id="vp-disc" value="'+disc+'%" readonly></div>';
  html+='<div class="fld"><label>Cost</label><input type="number" id="vp-cost" value="'+v.cost+'" oninput="calcVPricing()"></div>';
  html+='<div class="fld"><label>Margin %</label><input type="text" id="vp-margin" value="'+margin+'%" readonly></div></div>';
  html+='<button class="btn-sm mt-8" onclick="saveVPricing()">Save Pricing</button></div>';
  html+='<div class="card"><div class="sect-hd"><h3>Barcode</h3></div>';
  html+='<div class="fld"><div class="row gap-8"><input type="text" id="vp-barcode" value="'+esc(v.barcode)+'" placeholder="Enter barcode or SKU" style="flex:1;"><button class="btn-sm" onclick="document.getElementById(\'vp-barcode\').value=\''+esc(v.sku)+'\'">Set to SKU</button></div></div>';
  html+='<div style="display:flex;gap:8px;"><button class="btn-sm" onclick="saveVBarcode()">Save</button><button class="btn-sm" onclick="openAddLabel('+m.id+','+vi+')">🖨 Print Label</button></div></div>';
  return html;
}
function calcVPricing(){
  var mrp=parseFloat(document.getElementById('vp-mrp').value)||0;
  var offer=parseFloat(document.getElementById('vp-offer').value)||0;
  var cost=parseFloat(document.getElementById('vp-cost').value)||0;
  var disc=mrp>0?Math.round((mrp-offer)/mrp*100):0;
  var margin=offer>0?Math.round((offer-cost)/offer*100):0;
  document.getElementById('vp-disc').value=disc+'%';
  document.getElementById('vp-margin').value=margin+'%';
}
function saveVPricing(){
  var m=getMat(window._vdMatId);var v=m.variants[window._vdVi];
  v.mrp=parseFloat(document.getElementById('vp-mrp').value)||0;
  v.offer=parseFloat(document.getElementById('vp-offer').value)||0;
  v.cost=parseFloat(document.getElementById('vp-cost').value)||0;
  showToast('Pricing saved');
}
function saveVBarcode(){
  var m=getMat(window._vdMatId);var v=m.variants[window._vdVi];
  v.barcode=document.getElementById('vp-barcode').value;
  showToast('Barcode saved');
}
function buildVInventory(m,vi){
  var v=m.variants[vi];
  var reserved=v.reservations.reduce(function(s,r){return s+r.qty;},0);
  var available=v.qty-reserved;
  var html='<div class="stat-row"><div class="stat-tile"><div class="stat-val">'+v.qty+'</div><div class="stat-lbl">Total</div></div>';
  html+='<div class="stat-tile"><div class="stat-val">'+Math.max(0,available)+'</div><div class="stat-lbl">Available</div></div>';
  html+='<div class="stat-tile"><div class="stat-val">'+reserved+'</div><div class="stat-lbl">Reserved</div></div></div>';
  html+='<div class="card">';
  html+=buildSparkline(v);
  html+='</div>';
  // Location breakdown
  html+='<div class="card">';
  ['stores','jobbers','production','warehouse'].forEach(function(key){
    var locs=v.inventory[key];if(!locs||!locs.length)return;
    html+='<div class="sect-hd" style="margin-bottom:8px;"><h3>'+key.charAt(0).toUpperCase()+key.slice(1)+'</h3></div>';
    locs.forEach(function(l){
      html+='<div class="loc-row"><div class="row gap-8"><div class="dot" style="background:'+l.color+'"></div><span>'+esc(l.loc)+'</span></div><span class="fw-6">'+l.qty+'</span></div>';
    });
  });
  html+='</div>';
  html+='<div style="display:flex;gap:8px;"><button class="btn-p flex-1" onclick="openMoveSheet('+m.id+','+vi+')">Record movement</button>';
  html+='<button class="btn-s flex-1" onclick="openStockCount('+m.id+','+vi+')">Stock count</button></div>';
  // Reservations
  html+='<div class="card"><div class="sect-hd"><h3>Reservations</h3><button class="btn-sm" onclick="openReserve()">+ Add</button></div>';
  if(v.reservations.length){
    v.reservations.forEach(function(r,ri){
      html+='<div class="loc-row"><div><div class="fw-6 fs-13">'+esc(r.customer||'')+'</div><div class="tx2 fs-12">'+esc(r.order||'')+'</div></div><span class="fw-6">'+r.qty+'</span></div>';
    });
  } else {html+='<div class="tx3 fs-12 text-center" style="padding:12px;">No reservations</div>';}
  html+='</div>';
  return html;
}
function buildSparkline(v){
  var weeks=[];
  var now=new Date();
  for(var i=15;i>=0;i--){var d=new Date(now);d.setDate(d.getDate()-i*7);weeks.push({date:d.toISOString().split('T')[0],qty:0});}
  var running=0;
  var mvs=v.movements.slice().sort(function(a,b){return a.date.localeCompare(b.date);});
  mvs.forEach(function(mv){running+=(mv.type==='Stock in'?1:-1)*mv.qty;});
  var pts=weeks.map(function(){return Math.max(0,v.qty+Math.round((Math.random()-0.3)*5));});
  var max=Math.max.apply(null,pts)||1;
  var w=300,h=60,pad=4;
  var xStep=(w-pad*2)/(pts.length-1);
  var points=pts.map(function(p,i){return [(pad+i*xStep).toFixed(1),((h-pad)-(p/max*(h-pad*2))).toFixed(1)].join(',');}).join(' ');
  return '<svg class="sparkline" viewBox="0 0 '+w+' '+h+'" xmlns="http://www.w3.org/2000/svg"><polyline points="'+points+'" fill="none" stroke="var(--p)" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"/></svg>';
}
function openMoveSheet(matId,vi){
  window._mvMatId=matId;window._mvVi=vi;
  document.getElementById('mv-date').value=todayStr();
  document.getElementById('mv-qty').value='';
  document.getElementById('mv-rate').value='';
  document.getElementById('mv-ref').value='';
  document.getElementById('mv-note').value='';
  openSheet('sh-move');
}
function doRecordMovement(){
  var matId=window._mvMatId;var vi=window._mvVi;
  var m=getMat(matId);if(!m)return;
  var qty=parseInt(document.getElementById('mv-qty').value)||0;
  if(!qty){showToast('Enter a quantity','error');return;}
  var type=document.getElementById('mv-type').value;
  var mv={date:document.getElementById('mv-date').value||todayStr(),type:type,subtype:'Manual',qty:qty,rate:parseFloat(document.getElementById('mv-rate').value)||0,ref:document.getElementById('mv-ref').value,note:document.getElementById('mv-note').value};
  m.variants[vi].movements.push(mv);
  if(type==='Stock in')m.variants[vi].qty+=qty;
  else if(type==='Stock out')m.variants[vi].qty=Math.max(0,m.variants[vi].qty-qty);
  else if(type==='Adjustment')m.variants[vi].qty=qty;
  closeSheet('sh-move');
  showToast('Movement recorded');
  setVTab(1);
  renderList();
}
function recordMovement(matId,vi,entry){
  var m=getMat(matId);if(!m)return;
  m.variants[vi].movements.push(entry);
}
function openStockCount(matId,vi){
  window._scMatId=matId;window._scVi=vi;
  var m=getMat(matId);var v=m.variants[vi];
  document.getElementById('sc-title').textContent='Stock Count · '+v.name;
  document.getElementById('sc-system').textContent='System qty: '+v.qty+' '+m.unit;
  document.getElementById('sc-physical').value='';
  document.getElementById('sc-diff').style.display='none';
  openSheet('sh-stockcount');
}
function calcStockDiff(){
  var m=getMat(window._scMatId);var v=m.variants[window._scVi];
  var physical=parseInt(document.getElementById('sc-physical').value);
  if(isNaN(physical)){document.getElementById('sc-diff').style.display='none';return;}
  var diff=physical-v.qty;
  var el=document.getElementById('sc-diff');
  el.style.display='block';
  el.style.background=diff<0?'var(--rl)':diff>0?'var(--gl)':'var(--sf2)';
  el.style.color=diff<0?'var(--rt)':diff>0?'var(--gt)':'var(--tx2)';
  el.textContent='System: '+v.qty+' → Physical: '+physical+'. Adjustment: '+(diff>0?'+':'')+diff;
}
function doStockCountConfirm(){
  var m=getMat(window._scMatId);var v=m.variants[window._scVi];
  var physical=parseInt(document.getElementById('sc-physical').value);
  if(isNaN(physical)){showToast('Enter physical count','error');return;}
  var diff=physical-v.qty;
  v.movements.push({date:todayStr(),type:'Adjustment',subtype:'Stock count',qty:Math.abs(diff),rate:0,ref:'',note:'Stock count (system: '+v.qty+', physical: '+physical+')'});
  v.qty=physical;
  closeSheet('sh-stockcount');
  showToast('Stock count saved');
  setVTab(1);
  renderList();
}
function doStockCount(matId,vi,physicalQty){
  var m=getMat(matId);var v=m.variants[vi];
  var diff=physicalQty-v.qty;
  v.movements.push({date:todayStr(),type:'Adjustment',subtype:'Stock count',qty:Math.abs(diff),rate:0,ref:'',note:'Stock count (system: '+v.qty+', physical: '+physicalQty+')'});
  v.qty=physicalQty;
}
function openReserve(){
  document.getElementById('rv-date').value=todayStr();
  document.getElementById('rv-ref').value='';
  document.getElementById('rv-customer').value='';
  document.getElementById('rv-qty').value='1';
  openSheet('sh-reserve');
}
function doAddReservation(){
  var m=getMat(window._vdMatId);var v=m.variants[window._vdVi];
  var qty=parseInt(document.getElementById('rv-qty').value)||0;
  if(!qty){showToast('Enter quantity','error');return;}
  v.reservations.push({order:document.getElementById('rv-ref').value,customer:document.getElementById('rv-customer').value,qty:qty,date:document.getElementById('rv-date').value,status:'active'});
  closeSheet('sh-reserve');
  showToast('Reservation added');
  setVTab(1);
}

// ==================== BOM ====================
function resolveBOM(m,vi){
  var v=m.variants[vi];
  var resolved=m.bom.map(function(line){return Object.assign({},line,{_src:'product'});});
  (v.bomOverrides||[]).forEach(function(ovr){
    var idx=resolved.findIndex(function(l){return l.materialId===ovr.materialId;});
    if(idx>=0)resolved[idx]=Object.assign({},ovr,{_src:'override'});
    else resolved.push(Object.assign({},ovr,{_src:'override'}));
  });
  return resolved;
}
function buildVBOM(m,vi){
  var v=m.variants[vi];
  var resolved=resolveBOM(m,vi);
  var hasOverrides=v.bomOverrides&&v.bomOverrides.length>0;
  var html='<div class="card">';
  html+='<div class="row-between mb-8"><span class="fw-6">BOM for '+esc(v.name)+'</span>';
  html+='<span class="badge '+(hasOverrides?'badge-amber':'badge-grey')+'">'+(hasOverrides?'Has overrides':'Inherited from product')+'</span></div>';
  if(resolved.length){
    resolved.forEach(function(line,i){
      html+='<div class="bom-row"><div class="bom-info"><div class="bom-mat">'+esc(line.materialName)+'</div>';
      if(line.note)html+='<div class="bom-note">'+esc(line.note)+'</div>';
      html+='</div><div class="bom-qty">'+line.qty+' '+esc(line.unit)+'</div>';
      html+='<span class="tag-'+(line._src==='override'?'override':'inherited')+'">'+(line._src==='override'?'override':'inherited')+'</span>';
      html+='<button class="btn-ghost" onclick="openBOMLineSheet('+m.id+','+vi+',false,'+JSON.stringify(line)+')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>';
      html+='<button class="btn-ghost" onclick="deleteBOMLine('+m.id+','+vi+','+i+')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg></button>';
      html+='</div>';
    });
  } else {html+='<div class="tx3 text-center" style="padding:16px;">No BOM lines</div>';}
  html+='<div class="row gap-8 mt-8"><button class="btn-sm" onclick="openBOMLineSheet('+m.id+','+vi+',false,null)">+ Add line</button>';
  if(!hasOverrides)html+='<button class="btn-sm" onclick="copyProdBOM('+m.id+','+vi+')">Copy from product BOM</button>';
  html+='<button class="btn-sm" onclick="applyBOMToAll('+m.id+','+vi+')">Apply to all</button></div></div>';
  // TechPack
  html+='<div class="card"><div class="sect-hd"><h3>TechPack Document</h3></div>';
  html+='<div class="fld"><label>URL</label><input type="text" id="tp-url" value="'+esc(m.techpackUrl||'')+'" placeholder="https://drive.google.com/..."></div>';
  html+='<div style="display:flex;gap:8px;"><button class="btn-sm" onclick="saveTechpackUrl()">Save URL</button><button class="btn-sm">+ Upload file</button></div>';
  if(m.externalLinks&&m.externalLinks.length){
    html+='<div class="divider"></div><div class="sect-hd"><h3>External Links</h3></div>';
    m.externalLinks.forEach(function(lk,i){html+='<div class="loc-row"><span>'+esc(lk.label)+'</span><a href="'+esc(lk.url)+'" target="_blank" class="txp fs-13">Open</a></div>';});
  }
  html+='<button class="btn-sm mt-8" onclick="addExtLink('+m.id+')">+ Add link</button></div>';
  return html;
}
function openBOMLineSheet(matId,vi,isProductLevel,existingLine){
  _bomContext={matId:matId,vi:vi,isProductLevel:isProductLevel,existingLine:existingLine||null};
  document.getElementById('bl-title').textContent=existingLine?'Edit BOM Line':'Add BOM Line';
  // Populate material picker
  var sel=document.getElementById('bl-mat');
  sel.innerHTML='<option value="">Select material…</option>';
  materials.filter(function(m){return m.type==='raw';}).forEach(function(m){
    sel.innerHTML+='<option value="'+m.id+'" '+(existingLine&&existingLine.materialId===m.id?'selected':'')+'>'+esc(m.name)+'</option>';
  });
  if(existingLine){
    document.getElementById('bl-qty').value=existingLine.qty||'';
    document.getElementById('bl-unit').value=existingLine.unit||'metres';
    document.getElementById('bl-note').value=existingLine.note||'';
    renderBLVariants();
  } else {
    document.getElementById('bl-qty').value='';
    document.getElementById('bl-note').value='';
    document.getElementById('bl-var-row').style.display='none';
  }
  openSheet('sh-bomline');
}
function renderBLVariants(){
  var matId=parseInt(document.getElementById('bl-mat').value);
  var row=document.getElementById('bl-var-row');
  var varSel=document.getElementById('bl-var');
  if(!matId){row.style.display='none';return;}
  var m=getMat(matId);
  if(!m||!m.variants.length){row.style.display='none';return;}
  row.style.display='block';
  varSel.innerHTML='<option value="">Any variant</option>';
  m.variants.forEach(function(v,i){varSel.innerHTML+='<option value="'+i+'">'+esc(v.name)+'</option>';});
}
function doSaveBOMLine(){
  var matId=parseInt(document.getElementById('bl-mat').value);
  if(!matId){showToast('Select a material','error');return;}
  var mat=getMat(matId);if(!mat)return;
  var vi=document.getElementById('bl-var').value;
  var qty=parseFloat(document.getElementById('bl-qty').value)||0;
  if(!qty){showToast('Enter quantity','error');return;}
  var unit=document.getElementById('bl-unit').value;
  var note=document.getElementById('bl-note').value;
  var ctx=_bomContext;
  var line={id:uuid(),materialId:matId,materialName:mat.name,variantIdx:vi!==''?parseInt(vi):null,qty:qty,unit:unit,note:note,isVariantOverride:!ctx.isProductLevel};
  if(ctx.isProductLevel){
    // Product-level BOM (from create screen)
    var m2=ctx.matId?getMat(ctx.matId):null;
    if(m2){
      var existing=m2.bom.findIndex(function(l){return l.materialId===matId;});
      if(existing>=0)m2.bom[existing]=line;
      else m2.bom.push(line);
    }
    closeSheet('sh-bomline');
    setCTab(0);
  } else {
    // Variant-level override
    var m3=getMat(ctx.matId);
    var v=m3.variants[ctx.vi];
    var eidx=v.bomOverrides.findIndex(function(l){return l.materialId===matId;});
    if(eidx>=0)v.bomOverrides[eidx]=line;
    else v.bomOverrides.push(line);
    closeSheet('sh-bomline');
    setVTab(2);
  }
  showToast('BOM line saved');
}
function deleteBOMLine(matId,vi,idx){
  var m=getMat(matId);var resolved=resolveBOM(m,vi);
  var line=resolved[idx];
  if(!line)return;
  if(line._src==='override'){
    var oidx=m.variants[vi].bomOverrides.findIndex(function(l){return l.materialId===line.materialId;});
    if(oidx>=0)m.variants[vi].bomOverrides.splice(oidx,1);
  } else {
    var bidx=m.bom.findIndex(function(l){return l.materialId===line.materialId;});
    if(bidx>=0)m.bom.splice(bidx,1);
  }
  setVTab(2);showToast('Line removed');
}
function copyProdBOM(matId,vi){
  var m=getMat(matId);var v=m.variants[vi];
  v.bomOverrides=m.bom.map(function(l){return Object.assign({},l,{id:uuid(),isVariantOverride:true});});
  setVTab(2);showToast('Product BOM copied to variant');
}
function applyBOMToAll(matId,vi){
  if(!confirm('Apply this variant\'s BOM to all variants as the new product BOM?'))return;
  var m=getMat(matId);var v=m.variants[vi];
  m.bom=resolveBOM(m,vi).map(function(l){return Object.assign({},l,{isVariantOverride:false});});
  m.variants.forEach(function(vv){vv.bomOverrides=[];});
  setVTab(2);showToast('BOM applied to all variants');
}
function saveTechpackUrl(){
  var m=getMat(window._vdMatId);
  m.techpackUrl=document.getElementById('tp-url').value;
  showToast('TechPack URL saved');
}
function addExtLink(matId){
  var label=prompt('Link label:');if(!label)return;
  var url=prompt('URL:');if(!url)return;
  var m=getMat(matId);
  m.externalLinks.push({label:label,url:url});
  setVTab(2);showToast('Link added');
}

// ==================== COSTING ====================
function buildVCosting(m,vi){
  var v=m.variants[vi];
  var total=v.costLines.reduce(function(s,l){return s+l.amount;},0);
  var margin=v.mrp>0?((v.offer-total)/v.offer*100).toFixed(1):0;
  var html='<div class="card"><div class="sect-hd"><h3>Cost Lines</h3><button class="btn-sm" onclick="addCostLine()">+ Add</button></div>';
  if(v.costLines.length){
    v.costLines.forEach(function(l,i){
      html+='<div class="costing-row"><span class="costing-desc">'+esc(l.desc)+'</span><span class="costing-amt">'+fmtCurr(l.amount)+'</span><button class="btn-ghost" onclick="removeCostLine('+i+')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>';
    });
  } else {html+='<div class="tx3 text-center" style="padding:12px;">No cost lines yet</div>';}
  html+='<div class="divider"></div><div class="row-between"><span class="fw-6">Total Cost</span><span class="fw-6 txp">'+fmtCurr(total)+'</span></div></div>';
  html+='<div class="card"><div class="sect-hd"><h3>Margin Analysis</h3></div>';
  html+='<div class="loc-row"><span>MRP</span><span class="fw-6">'+fmtCurr(v.mrp)+'</span></div>';
  html+='<div class="loc-row"><span>Offer Price</span><span class="fw-6">'+fmtCurr(v.offer)+'</span></div>';
  html+='<div class="loc-row"><span>Total Cost</span><span class="fw-6">'+fmtCurr(total)+'</span></div>';
  html+='<div class="loc-row"><span>Gross Margin</span><span class="fw-6" style="color:var(--g)">'+fmtCurr(v.offer-total)+' ('+margin+'%)</span></div></div>';
  return html;
}
function addCostLine(){
  var desc=prompt('Description (e.g. Labour, Fabric):');if(!desc)return;
  var amt=parseFloat(prompt('Amount (₹):')||'0');
  var m=getMat(window._vdMatId);var v=m.variants[window._vdVi];
  v.costLines.push({desc:desc,amount:amt});
  setVTab(3);
}
function removeCostLine(i){
  var m=getMat(window._vdMatId);var v=m.variants[window._vdVi];
  v.costLines.splice(i,1);setVTab(3);
}

// ==================== PRODUCTION TAB ====================
function buildVProduction(m,vi){
  var v=m.variants[vi];
  var lots=window._productionLots||[];
  var b2b=lots.filter(function(l){return l.finishedMatId===m.id&&l.finishedVarIdx===vi&&l.type==='b2b';});
  var b2c=lots.filter(function(l){return l.finishedMatId===m.id&&l.finishedVarIdx===vi&&l.type==='b2c';});
  var html='<div class="note mb-8">Production lots are managed in the Production module. Shown here for reference.</div>';
  // B2B
  html+='<div class="prod-section"><div class="prod-section-hd"><span class="prod-section-title">B2B Lots</span><span class="badge badge-grey">'+b2b.length+' total</span></div>';
  if(!b2b.length)html+='<div class="tx3 fs-12 text-center" style="padding:16px;">No B2B lots yet</div>';
  b2b.forEach(function(l){
    html+='<div class="lot-row"><div class="lot-info"><div class="lot-no">Lot #'+esc(l.lotId)+'</div><div class="lot-sub">'+l.qty+' pcs · Started '+esc(l.startDate)+'</div></div><span class="chip '+(l.status==='completed'?'chip-ok':l.status==='cancelled'?'chip-out':'chip-low')+'">'+l.status+'</span></div>';
  });
  html+='<button class="btn-sm mt-8" onclick="showToast(\'Production module coming soon\',\'info\')">+ New B2B lot</button></div>';
  // B2C
  html+='<div class="prod-section"><div class="prod-section-hd"><span class="prod-section-title">B2C Orders</span><span class="badge badge-grey">'+b2c.length+' total</span></div>';
  if(!b2c.length)html+='<div class="tx3 fs-12 text-center" style="padding:16px;">No B2C orders yet</div>';
  b2c.forEach(function(l){
    html+='<div class="lot-row"><div class="lot-info"><div class="lot-no">Order #'+esc(l.linkedOrderId||l.lotId)+'</div><div class="lot-sub">'+l.qty+' pcs · '+esc(l.buyerName||'')+'</div></div><span class="chip '+(l.status==='completed'?'chip-ok':l.status==='cancelled'?'chip-out':'chip-low')+'">'+l.status+'</span></div>';
  });
  html+='<button class="btn-sm mt-8" onclick="showToast(\'Production module coming soon\',\'info\')">+ New B2C order</button></div>';
  return html;
}
window._productionLots=[];

// ==================== MATERIAL DETAIL ====================
function openMDetail(matId){
  window._mdMatId=matId;
  var m=getMat(matId);
  document.getElementById('md-title').textContent=m.name;
  // Summary
  var ts=totalStock(m);
  var st=ts<=0?'out':(m.variants.some(function(v){return v.minqty>0&&v.qty<=v.minqty;}))?'low':'ok';
  var sumHtml='<div class="card" style="margin:0 0 0 0;">';
  sumHtml+='<div class="row gap-8 mb-8"><span class="chip '+typeChipClass(m.type)+'">'+m.type+'</span><span class="tx2 fs-12">'+esc(m.sku)+'</span></div>';
  if(m.vendors&&m.vendors.length)sumHtml+='<div class="tx2 fs-12 mb-4">Vendor: '+m.vendors.map(function(v){return esc(v.name);}).join(', ')+'</div>';
  sumHtml+='<div class="row-between"><span class="tx2 fs-13">Total stock</span><span class="fw-6 fs-16">'+ts+' '+esc(m.unit)+'</span></div>';
  sumHtml+='</div>';
  document.getElementById('md-summary').innerHTML=sumHtml;
  setMTab(0);
  showScreen('s-mdetail');
}
function setMTab(n){
  var tabs=document.querySelectorAll('#s-mdetail .tab');
  tabs.forEach(function(t,i){t.classList.toggle('on',i===n);});
  for(var i=0;i<4;i++){var el=document.getElementById('md-tab-'+i);if(el)el.style.display=i===n?'flex':'none';}
  var m=getMat(window._mdMatId);if(!m)return;
  var tab=document.getElementById('md-tab-'+n);
  if(n===0)tab.innerHTML=buildMDVariants(m);
  else if(n===1)tab.innerHTML=buildMDSupply(m);
  else if(n===2)tab.innerHTML=buildMDProduction(m);
  else if(n===3)tab.innerHTML=buildMDCollections(m);
}
function buildMDVariants(m){
  var html='<div class="card">';
  html+='<div class="sect-hd"><h3>'+m.variants.length+' Variants</h3></div>';
  m.variants.forEach(function(v,i){
    var st=stockStatus(v);
    html+='<div class="var-row"><div class="var-swatch" style="background:'+v.color+'"></div>';
    html+='<div class="var-info"><div class="var-name">'+esc(v.name)+'</div><div class="var-sku">'+esc(v.sku)+'</div></div>';
    html+='<span class="fw-6 fs-13">'+v.qty+'</span>';
    html+='<span class="dot dot-'+st+'"></span>';
    html+='<div class="var-actions"><button class="btn-sm" onclick="openVDetail('+m.id+','+i+')">Edit →</button>';
    html+='<button class="btn-sm" onclick="openAddLabel('+m.id+','+i+')">🏷</button></div></div>';
  });
  html+='</div>';
  return html;
}
function buildMDSupply(m){
  var allReservations=[];
  m.variants.forEach(function(v,vi){
    v.reservations.forEach(function(r){allReservations.push(Object.assign({},r,{variantName:v.name}));});
  });
  var html='<div class="card"><div class="sect-hd"><h3>Reservations</h3></div>';
  if(!allReservations.length)html+='<div class="tx3 text-center" style="padding:16px;">No reservations</div>';
  allReservations.forEach(function(r){
    html+='<div class="loc-row"><div><div class="fw-6 fs-13">'+esc(r.customer||'')+'</div><div class="tx2 fs-12">'+esc(r.variantName)+' · '+esc(r.order||'')+'</div></div><span class="fw-6">'+r.qty+'</span></div>';
  });
  html+='</div>';
  html+='<div class="card"><div class="sect-hd"><h3>Production Queue</h3></div><div class="tx3 text-center" style="padding:16px;">Connect to Production module to view queue</div></div>';
  return html;
}
function buildMDProduction(m){
  var lots=window._productionLots||[];
  var html='';
  m.variants.forEach(function(v,vi){
    var b2b=lots.filter(function(l){return l.finishedMatId===m.id&&l.finishedVarIdx===vi&&l.type==='b2b';});
    var b2c=lots.filter(function(l){return l.finishedMatId===m.id&&l.finishedVarIdx===vi&&l.type==='b2c';});
    if(!b2b.length&&!b2c.length)return;
    html+='<div class="card"><div class="fw-6 fs-13 mb-8">'+esc(v.name)+'</div>';
    b2b.forEach(function(l){html+='<div class="lot-row"><div class="lot-info"><div class="lot-no">B2B Lot #'+esc(l.lotId)+'</div><div class="lot-sub">'+l.qty+' pcs</div></div><span class="chip chip-low">'+l.status+'</span></div>';});
    b2c.forEach(function(l){html+='<div class="lot-row"><div class="lot-info"><div class="lot-no">B2C #'+esc(l.linkedOrderId||l.lotId)+'</div><div class="lot-sub">'+l.qty+' pcs</div></div><span class="chip chip-low">'+l.status+'</span></div>';});
    html+='</div>';
  });
  if(!html)html='<div class="empty-state"><div>No production lots for this material</div></div>';
  html+='<button class="btn-sm" onclick="showToast(\'Production module coming soon\',\'info\')">+ New lot</button>';
  return html;
}
function buildMDCollections(m){
  var myCols=collections.filter(function(c){return c.manualIds&&c.manualIds.indexOf(m.id)>=0;});
  var html='<div class="card"><div class="sect-hd"><h3>Collections</h3><button class="btn-sm" onclick="renderCollections();showScreen(\'s-collections\')">Manage</button></div>';
  if(!myCols.length)html+='<div class="tx3 text-center" style="padding:16px;">Not in any collections</div>';
  myCols.forEach(function(c){
    html+='<div class="loc-row"><div class="row gap-8"><div class="dot" style="background:'+c.color+'"></div><span class="fw-6">'+esc(c.name)+'</span></div><span class="tx2 fs-12">'+c.manualIds.length+' products</span></div>';
  });
  html+='</div>';
  return html;
}

// ==================== MATERIAL IN ====================
var _miItems=[];
function initMatIn(){
  _miItems=[];
  document.getElementById('mi-entryno').value='MI-'+Date.now();
  document.getElementById('mi-date').value=todayStr();
  document.getElementById('mi-type').value='purchase';
  document.getElementById('mi-vendor').value='';
  document.getElementById('mi-invref').value='';
  document.getElementById('mi-notes').value='';
  document.getElementById('mi-gst-toggle').checked=false;
  document.getElementById('mi-gst-row').style.display='none';
  renderMiItems();
}
function renderMiItems(){
  var html='';
  _miItems.forEach(function(item,i){
    html+='<div class="in-item"><div class="in-item-hd"><span class="in-item-mat">'+(item.matName?esc(item.matName)+' / '+esc(item.varName):'Tap to select material')+'</span>';
    html+='<button class="btn-ghost" onclick="removeMiItem('+i+')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>';
    html+='<div onclick="pickMatItem('+i+')" style="cursor:pointer;padding:8px;background:var(--sf2);border-radius:8px;font-size:12px;color:var(--tx2);margin-bottom:8px;">'+(item.matName?'Change item':'+ Select material')+'</div>';
    html+='<div class="in-item-fields"><div class="fld"><label>Qty</label><input type="number" value="'+(item.qty||'')+'" min="0" oninput="_miItems['+i+'].qty=parseFloat(this.value)||0;calcMiTotal()" placeholder="0"></div>';
    html+='<div class="fld"><label>Rate ₹</label><input type="number" value="'+(item.rate||'')+'" min="0" oninput="_miItems['+i+'].rate=parseFloat(this.value)||0;calcMiTotal()" placeholder="0"></div></div>';
    var amt=(item.qty||0)*(item.rate||0);
    html+='<div class="row-between"><span class="tx2 fs-12">Amount</span><span class="fw-6">'+fmtCurr(amt)+'</span></div>';
    html+='</div>';
  });
  document.getElementById('mi-items').innerHTML=html;
  calcMiTotal();
}
function addMatInItem(){_miItems.push({matId:null,varIdx:null,matName:'',varName:'',qty:0,rate:0});renderMiItems();}
function removeMatInItem(i){_miItems.splice(i,1);renderMiItems();}
function removeMiItem(i){removeMatInItem(i);}
function calcMiTotal(){
  var sub=_miItems.reduce(function(s,item){return s+(item.qty||0)*(item.rate||0);},0);
  document.getElementById('mi-subtotal').textContent=fmtCurr(sub);
  var gst=document.getElementById('mi-gst-toggle').checked;
  var pct=parseFloat(document.getElementById('mi-gst-pct').value)||0;
  var gstAmt=gst?sub*pct/100:0;
  if(document.getElementById('mi-gst-amt'))document.getElementById('mi-gst-amt').textContent=fmtCurr(gstAmt);
  document.getElementById('mi-grand-total').textContent=fmtCurr(sub+gstAmt);
}
function toggleMiGst(){
  var on=document.getElementById('mi-gst-toggle').checked;
  document.getElementById('mi-gst-row').style.display=on?'flex':'none';
  calcMiTotal();
}
function saveMatIn(){
  if(!_miItems.length){showToast('Add at least one item','error');return;}
  var sub=_miItems.reduce(function(s,i){return s+(i.qty||0)*(i.rate||0);},0);
  var entry={id:nextId(matInEntries),entryNo:document.getElementById('mi-entryno').value,date:document.getElementById('mi-date').value,purchaseType:document.getElementById('mi-type').value,vendor:document.getElementById('mi-vendor').value,invoiceRef:document.getElementById('mi-invref').value,notes:document.getElementById('mi-notes').value,items:_miItems.slice(),gstApplicable:document.getElementById('mi-gst-toggle').checked,gstPct:parseFloat(document.getElementById('mi-gst-pct').value)||0,grandTotal:parseFloat(document.getElementById('mi-grand-total').textContent.replace('₹','').replace(/,/g,''))||0};
  matInEntries.push(entry);
  // Update stock
  _miItems.forEach(function(item){
    if(item.matId!==null&&item.varIdx!==null){
      var m=getMat(item.matId);
      if(m&&m.variants[item.varIdx]){
        m.variants[item.varIdx].qty+=item.qty||0;
        m.variants[item.varIdx].movements.push({date:entry.date,type:'Stock in',subtype:'Purchase',qty:item.qty,rate:item.rate,ref:entry.invoiceRef,note:entry.notes});
      }
    }
  });
  renderList();
  showToast('Material In saved');
  goBack();
}
function renderMatIn(){initMatIn();}

// ==================== MATERIAL OUT ====================
var _moItems=[];
function initMatOut(){
  _moItems=[];
  document.getElementById('mo-entryno').value='MO-'+Date.now();
  document.getElementById('mo-date').value=todayStr();
  document.getElementById('mo-type').value='jobber';
  document.getElementById('mo-notes').value='';
  renderMoRecipient();
  renderMoItems();
}
function renderMoRecipient(){
  var type=document.getElementById('mo-type').value;
  var html='';
  if(type==='jobber'){html='<div class="fld"><label>Jobber Name</label><input type="text" id="mo-jobber" placeholder="Jobber name"></div><div class="fld"><label>Job Ref</label><input type="text" id="mo-jobref" placeholder="Job-001"></div>';}
  else if(type==='customer'){html='<div class="fld"><label>Customer Name</label><input type="text" id="mo-customer" placeholder="Customer name"></div><div class="fld"><label>Order Ref</label><input type="text" id="mo-orderref" placeholder="ORD-001"></div><div class="fld"><label>Delivery Method</label><input type="text" id="mo-delivery" placeholder="Courier / Pickup"></div>';}
  else if(type==='sales'){html='<div class="fld"><label>Customer Name</label><input type="text" id="mo-customer" placeholder="Customer name"></div><div class="fld"><label>Invoice Ref</label><input type="text" id="mo-invref" placeholder="INV-001"></div>';}
  else{html='<div class="fld"><label>Recipient</label><input type="text" id="mo-recipient" placeholder="Recipient"></div><div class="fld"><label>Reason</label><input type="text" id="mo-reason" placeholder="Reason for transfer"></div>';}
  document.getElementById('mo-recipient-fields').innerHTML=html;
}
function renderMoItems(){
  var html='';
  _moItems.forEach(function(item,i){
    html+='<div class="in-item"><div class="in-item-hd"><span class="in-item-mat">'+(item.matName?esc(item.matName)+' / '+esc(item.varName):'Tap to select material')+'</span>';
    html+='<button class="btn-ghost" onclick="removeMoItem('+i+')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>';
    html+='<div onclick="pickMatItemOut('+i+')" style="cursor:pointer;padding:8px;background:var(--sf2);border-radius:8px;font-size:12px;color:var(--tx2);margin-bottom:8px;">'+(item.matName?'Change item':'+ Select material')+'</div>';
    html+='<div class="in-item-fields"><div class="fld"><label>Qty</label><input type="number" value="'+(item.qty||'')+'" min="0" oninput="_moItems['+i+'].qty=parseFloat(this.value)||0;calcMoTotal()" placeholder="0"></div>';
    html+='<div class="fld"><label>Rate ₹ (opt)</label><input type="number" value="'+(item.rate||'')+'" min="0" oninput="_moItems['+i+'].rate=parseFloat(this.value)||0;calcMoTotal()" placeholder="0"></div></div>';
    html+='</div>';
  });
  document.getElementById('mo-items').innerHTML=html;
  calcMoTotal();
}
function addMatOutItem(){_moItems.push({matId:null,varIdx:null,matName:'',varName:'',qty:0,rate:0});renderMoItems();}
function removeMoItem(i){_moItems.splice(i,1);renderMoItems();}
function calcMoTotal(){
  var total=_moItems.reduce(function(s,item){return s+(item.qty||0)*(item.rate||0);},0);
  document.getElementById('mo-total').textContent=fmtCurr(total);
}
function saveMatOut(){
  if(!_moItems.length){showToast('Add at least one item','error');return;}
  var entry={id:nextId(matOutEntries),entryNo:document.getElementById('mo-entryno').value,date:document.getElementById('mo-date').value,outType:document.getElementById('mo-type').value,notes:document.getElementById('mo-notes').value,items:_moItems.slice(),total:parseFloat((document.getElementById('mo-total').textContent||'').replace('₹','').replace(/,/g,''))||0};
  matOutEntries.push(entry);
  _moItems.forEach(function(item){
    if(item.matId!==null&&item.varIdx!==null){
      var m=getMat(item.matId);
      if(m&&m.variants[item.varIdx]){
        m.variants[item.varIdx].qty=Math.max(0,m.variants[item.varIdx].qty-(item.qty||0));
        m.variants[item.varIdx].movements.push({date:entry.date,type:'Stock out',subtype:entry.outType,qty:item.qty,rate:item.rate,ref:'',note:entry.notes});
      }
    }
  });
  renderList();showToast('Material Out saved');goBack();
}
function renderMatOut(){initMatOut();}

// ==================== MATERIAL PICKER ====================
function pickMatItem(idx){_matItemCallback=function(matId,vi,m,v){_miItems[idx].matId=matId;_miItems[idx].varIdx=vi;_miItems[idx].matName=m.name;_miItems[idx].varName=v.name;renderMiItems();};renderMatPicker();openSheet('sh-matitem');}
function pickMatItemOut(idx){_matItemCallback=function(matId,vi,m,v){_moItems[idx].matId=matId;_moItems[idx].varIdx=vi;_moItems[idx].matName=m.name;_moItems[idx].varName=v.name;renderMoItems();};renderMatPicker();openSheet('sh-matitem');}
function renderMatPicker(){
  var q=(document.getElementById('matpick-search')||{}).value||'';
  var filtered=materials.filter(function(m){return !q||m.name.toLowerCase().includes(q.toLowerCase());});
  var html='';
  filtered.forEach(function(m){
    html+='<div style="border-bottom:1px solid var(--br);padding:8px 0;"><div class="fw-6 fs-13 mb-4">'+esc(m.name)+'</div>';
    m.variants.forEach(function(v,vi){
      html+='<div class="var-row" style="padding:6px 8px;border-radius:8px;cursor:pointer;" onclick="selectMatItem('+m.id+','+vi+')"><div class="var-swatch" style="background:'+v.color+'"></div><div class="var-info"><div class="var-name">'+esc(v.name)+'</div></div><span class="tx2 fs-12">'+v.qty+' '+esc(m.unit)+'</span></div>';
    });
    html+='</div>';
  });
  document.getElementById('matpick-list').innerHTML=html||'<div class="tx3 text-center" style="padding:20px;">No materials found</div>';
}
function selectMatItem(matId,vi){
  var m=getMat(matId);var v=m.variants[vi];
  if(_matItemCallback)_matItemCallback(matId,vi,m,v);
  closeSheet('sh-matitem');
  _matItemCallback=null;
}

// ==================== LABELS ====================
var _lTab=0;
function renderLabels(){
  var body=document.getElementById('labels-body');
  if(!labelDesigns.length&&!labelQueue.length){
    body.innerHTML='<div class="empty-state" style="margin-top:80px;"><svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg><h3 style="color:var(--tx);">Set up label designs</h3><p>Create a design to start printing labels</p><button class="btn-p" style="width:auto;padding:10px 24px;" onclick="openNewLabelDesign()">+ Create Design</button></div>';
    return;
  }
  var html='<div class="tab-strip"><div class="tab-inner"><button class="tab'+(_lTab===0?' on':'')+'" onclick="setLTab(0)">Designs</button><button class="tab'+(_lTab===1?' on':'')+'" onclick="setLTab(1)">Queue ('+labelQueue.length+')</button></div></div>';
  if(_lTab===0){
    html+='<div class="body"><div class="grid-2">';
    labelDesigns.forEach(function(d,i){
      html+='<div class="lbl-card"><div class="lbl-name">'+esc(d.name)+'</div><div class="lbl-size">'+esc(d.size)+'</div><div class="lbl-fields">'+esc(d.fields.join(', '))+'</div>';
      html+='<div class="lbl-card-actions"><button class="btn-sm" onclick="editLabelDesign('+i+')">Edit</button><button class="btn-sm" onclick="dupLabelDesign('+i+')">Dup</button><button class="btn-danger fs-12" onclick="deleteLabelDesign('+i+')">Del</button></div></div>';
    });
    html+='</div><button class="btn-p mt-8" onclick="openNewLabelDesign()">+ New Design</button></div>';
  } else {
    html+='<div class="body">';
    if(labelQueue.length){
      html+='<div class="row-between mb-8"><button class="btn-ghost txp" onclick="labelQueue=[];renderLabels()">Clear all</button><button class="btn-sm" onclick="printAll()">🖨 Print All</button></div>';
      labelQueue.forEach(function(q,i){
        var m=getMat(q.matId);var v=m?m.variants[q.vi]:null;var d=labelDesigns.find(function(x){return x.id===q.designId;});
        html+='<div class="q-row"><div class="q-info"><div class="fw-6 fs-13">'+(m?esc(m.name):'?')+'</div><div class="tx2 fs-12">'+(v?esc(v.name):'?')+(d?' · '+esc(d.name):'')+'</div></div><span class="fw-6">×'+q.qty+'</span><button class="btn-ghost" onclick="removeFromQueue('+i+')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>';
      });
    } else {html+='<div class="empty-state"><div>Queue is empty. Add labels from material variants.</div></div>';}
    html+='</div>';
  }
  body.innerHTML=html;
}
function setLTab(n){_lTab=n;renderLabels();}
function openNewLabelDesign(){document.getElementById('ld-sheet-title').textContent='New Label Design';document.getElementById('ld-name').value='';window._editingDesignIdx=null;openSheet('sh-labeldesign');}
function editLabelDesign(i){var d=labelDesigns[i];window._editingDesignIdx=i;document.getElementById('ld-sheet-title').textContent='Edit Design';document.getElementById('ld-name').value=d.name;openSheet('sh-labeldesign');}
function dupLabelDesign(i){var d=Object.assign({},labelDesigns[i],{id:uuid(),name:labelDesigns[i].name+' copy'});labelDesigns.push(d);renderLabels();showToast('Design duplicated');}
function deleteLabelDesign(i){if(confirm('Delete this design?')){labelDesigns.splice(i,1);renderLabels();}}
function doSaveLabelDesign(){
  var name=document.getElementById('ld-name').value.trim();if(!name){showToast('Enter a name','error');return;}
  var fields=[];
  ['name','variant','mrp','offer','sku','barcode','designno','logo'].forEach(function(f){if(document.getElementById('ldf-'+f)&&document.getElementById('ldf-'+f).checked)fields.push(f);});
  var d={id:uuid(),name:name,size:document.getElementById('ld-size').value,fields:fields};
  if(window._editingDesignIdx!=null)labelDesigns[window._editingDesignIdx]=d;
  else labelDesigns.push(d);
  closeSheet('sh-labeldesign');
  renderLabels();showToast('Design saved');
}
function saveLabelDesign(d){labelDesigns.push(d);}
function openAddLabel(matId,vi){
  window._alMatId=matId;window._alVi=vi;
  var m=getMat(matId);var v=m.variants[vi];
  document.getElementById('al-matinfo').textContent=m.name+' / '+v.name;
  document.getElementById('al-qty').value='1';
  var html='';
  if(!labelDesigns.length){html='<div class="tx3 fs-12">No designs yet. <button class="btn-ghost txp" onclick="closeSheet(\'sh-addlabel\');openNewLabelDesign();">Create one</button></div>';}
  else{labelDesigns.forEach(function(d,i){html+='<label class="filter-opt"><input type="radio" name="al-design" value="'+d.id+'"> '+esc(d.name)+'</label>';});}
  document.getElementById('al-designs').innerHTML=html;
  openSheet('sh-addlabel');
}
function alQtyAdj(n){var el=document.getElementById('al-qty');el.value=Math.max(1,(parseInt(el.value)||1)+n);}
function doAddToQueue(){
  var sel=document.querySelector('input[name="al-design"]:checked');
  if(!sel&&labelDesigns.length){showToast('Select a design','error');return;}
  var qty=parseInt(document.getElementById('al-qty').value)||1;
  var entry={matId:window._alMatId,vi:window._alVi,designId:sel?sel.value:(labelDesigns[0]?labelDesigns[0].id:null),qty:qty};
  labelQueue.push(entry);
  closeSheet('sh-addlabel');showToast('Added to queue');
  renderLabels();
}
function addToQueue(entry){labelQueue.push(entry);}
function removeFromQueue(i){labelQueue.splice(i,1);renderLabels();}
function printAll(){showToast('Printing '+labelQueue.length+' labels…','info');}
function openLabelPreview(matId,vi,designId){
  window._lpMatId=matId;window._lpVi=vi;window._lpDesignId=designId;
  var m=getMat(matId);var v=m.variants[vi];var d=labelDesigns.find(function(x){return x.id===designId;})||{fields:['name','variant','mrp','offer']};
  var html='';
  if(d.fields.indexOf('name')>=0)html+='<div class="pl-name">'+esc(m.name)+'</div>';
  if(d.fields.indexOf('variant')>=0)html+='<div class="pl-var">'+esc(v.name)+'</div>';
  if(d.fields.indexOf('mrp')>=0)html+='<div class="pl-price">MRP '+fmtCurr(v.mrp)+'</div>';
  if(d.fields.indexOf('offer')>=0)html+='<div class="pl-price" style="color:var(--g);">'+fmtCurr(v.offer)+'</div>';
  if(d.fields.indexOf('sku')>=0)html+='<div class="pl-sku">'+esc(v.sku)+'</div>';
  document.getElementById('lp-label').innerHTML=html;
  showScreen('s-label-preview');
}
function lpQtyAdj(n){var el=document.getElementById('lp-qty');el.value=Math.max(1,(parseInt(el.value)||1)+n);}

// ==================== COLLECTIONS ====================
function renderCollections(){
  var html='';
  if(!collections.length){
    html='<div class="empty-state"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg><div>No collections yet</div><button class="btn-p" style="width:auto;padding:10px 20px;" onclick="openNewCol()">+ New Collection</button></div>';
  } else {
    html='';
    collections.forEach(function(c){
      html+='<div class="coll-card" onclick="openCDetail(\''+c.id+'\')"><div class="coll-hd"><div class="coll-dot" style="background:'+c.color+'"></div><div><div class="coll-name">'+esc(c.name)+'</div><div class="coll-count">'+(c.manualIds?c.manualIds.length:0)+' products</div></div></div>';
      if(c.desc)html+='<div class="tx2 fs-12 mb-8">'+esc(c.desc)+'</div>';
      html+='<div class="coll-thumbs"><div class="coll-thumb">👗</div><div class="coll-thumb">🧵</div></div>';
      html+='</div>';
    });
  }
  document.getElementById('collections-body').innerHTML=html;
}
function openNewCol(){window._editingColId=null;_currentColColor='#4A3BB5';document.getElementById('nc-title').textContent='New Collection';document.getElementById('nc-name').value='';document.getElementById('nc-desc').value='';document.querySelectorAll('.color-swatch').forEach(function(s){s.classList.toggle('sel',s.style.background==='#4A3BB5'||s.style.backgroundColor==='//#4A3BB5');});openSheet('sh-newcol');}
function openEditCol(id){var c=collections.find(function(x){return x.id===id;});if(!c)return;window._editingColId=id;_currentColColor=c.color;document.getElementById('nc-title').textContent='Edit Collection';document.getElementById('nc-name').value=c.name;document.getElementById('nc-desc').value=c.desc||'';openSheet('sh-newcol');}
function selectColColor(color,el){_currentColColor=color;document.querySelectorAll('.color-swatch').forEach(function(s){s.classList.remove('sel');});el.classList.add('sel');}
function doSaveCollection(){
  var name=document.getElementById('nc-name').value.trim();if(!name){showToast('Enter a name','error');return;}
  if(window._editingColId){var c=collections.find(function(x){return x.id===window._editingColId;});if(c){c.name=name;c.desc=document.getElementById('nc-desc').value;c.color=_currentColColor;}}
  else{collections.push({id:uuid(),name:name,desc:document.getElementById('nc-desc').value,color:_currentColColor,manualIds:[],tagRules:[],previewLink:'',previewEnabled:false,previewExpiry:''});}
  closeSheet('sh-newcol');renderCollections();showToast('Collection saved');
}
function saveCollection(c){collections.push(c);}
function openCDetail(id){
  window._cdColId=id;
  var c=collections.find(function(x){return x.id===id;});if(!c)return;
  document.getElementById('cd-title').textContent=c.name;
  var html='<div class="card"><div class="sect-hd"><h3>Products</h3><button class="btn-sm" onclick="addProductToCollection(\''+id+'\')">+ Add products</button></div>';
  var mats=materials.filter(function(m){return c.manualIds&&c.manualIds.indexOf(m.id)>=0;});
  if(!mats.length)html+='<div class="tx3 text-center" style="padding:16px;">No products in this collection</div>';
  mats.forEach(function(m){html+='<div class="loc-row"><span class="fw-6">'+esc(m.name)+'</span><button class="btn-ghost" onclick="removeFromCollection(\''+id+'\','+m.id+')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>';});
  html+='</div>';
  html+='<div class="card"><div class="sect-hd"><h3>Preview Link</h3></div>';
  html+='<div class="toggle-row mb-8"><span>Enable preview link</span><label class="toggle"><input type="checkbox" '+(c.previewEnabled?'checked':'')+' onchange="togglePreviewLink(\''+id+'\')"><span class="toggle-slider"></span></label></div>';
  if(c.previewEnabled&&c.previewLink){html+='<div class="fld"><div class="row gap-8"><input type="text" value="'+esc(c.previewLink)+'" readonly style="flex:1;font-size:12px;"><button class="btn-sm" onclick="copyPreviewLink()">Copy</button></div></div>';}
  html+='</div>';
  document.getElementById('cd-body').innerHTML=html;
  showScreen('s-cdetail');
}
function addProductToCollection(colId){
  var names=materials.map(function(m,i){return i+'. '+m.name;}).join('\n');
  var idx=parseInt(prompt('Select material by number:\n'+names));
  var m=materials[idx];
  if(!m)return;
  var c=collections.find(function(x){return x.id===colId;});
  if(c&&c.manualIds.indexOf(m.id)<0){c.manualIds.push(m.id);}
  openCDetail(colId);showToast('Product added');
}
function removeFromCollection(colId,matId){
  var c=collections.find(function(x){return x.id===colId;});
  if(c){c.manualIds=c.manualIds.filter(function(id){return id!==matId;});}
  openCDetail(colId);
}
function togglePreviewLink(id){
  var c=collections.find(function(x){return x.id===id;});if(!c)return;
  c.previewEnabled=!c.previewEnabled;
  if(c.previewEnabled&&!c.previewLink)c.previewLink=generatePreviewLink(id);
  openCDetail(id);
}
function generatePreviewLink(id){return window.location.origin+'/preview/'+id+'?t='+Date.now();}
function copyPreviewLink(){
  var c=collections.find(function(x){return x.id===window._cdColId;});
  if(c&&c.previewLink){navigator.clipboard.writeText(c.previewLink).then(function(){showToast('Link copied');}).catch(function(){showToast('Link: '+c.previewLink,'info');});}
}
function saveShareLink(){
  var c=collections.find(function(x){return x.id===window._cdColId;});
  if(c){c.previewExpiry=document.getElementById('sl-expiry').value;c.previewEnabled=document.getElementById('sl-toggle').checked;}
  closeSheet('sh-sharelink');showToast('Settings saved');
}

// ==================== ORDER REQUESTS ====================
var _reqFilter='all';
function setReqFilter(f){
  _reqFilter=f;
  ['all','pending','acknowledged','converted','rejected'].forEach(function(s){
    var el=document.getElementById('req-f-'+s);
    if(el)el.classList.toggle('on',s===f);
  });
  renderOrderRequests(f);
}
function renderOrderRequests(filter){
  filter=filter||_reqFilter||'all';
  var filtered=orderRequests.filter(function(r){return filter==='all'||r.status===filter;});
  var html='';
  if(!filtered.length){
    html='<div class="empty-state"><div>No requests'+(filter!=='all'?' with status "'+filter+'"':'')+'</div></div>';
  } else {
    filtered.forEach(function(r){
      var statusColors={pending:'chip-low',acknowledged:'chip-ok',converted:'chip-f',rejected:'chip-out'};
      html+='<div class="req-row" onclick="openRequestDetail(\''+r.id+'\')"><div class="req-client">'+esc(r.clientName)+'</div><div class="req-product">'+esc(r.productName)+' · '+esc(r.variantName)+'</div><div class="req-meta"><span class="tx3 fs-12">'+esc(r.requestDate)+'</span><span class="chip '+(statusColors[r.status]||'')+'">'+r.status+'</span></div></div>';
    });
  }
  document.getElementById('req-body').innerHTML=html;
}
function openRequestDetail(id){
  var r=orderRequests.find(function(x){return x.id===id;});if(!r)return;
  var html='<div class="fld"><label>Client</label><div class="fw-6">'+esc(r.clientName)+'</div></div>';
  html+='<div class="fld"><label>Contact</label><div>'+esc(r.clientContact||'')+'</div></div>';
  html+='<div class="fld"><label>Product</label><div>'+esc(r.productName)+' · '+esc(r.variantName)+'</div></div>';
  html+='<div class="fld"><label>Date</label><div>'+esc(r.requestDate)+'</div></div>';
  html+='<div class="fld"><label>Status</label><span class="chip chip-low">'+esc(r.status)+'</span></div>';
  document.getElementById('req-detail-body').innerHTML=html;
  var actions='';
  if(r.status==='pending'){actions+='<button class="btn-sm flex-1" onclick="updateRequestStatus(\''+r.id+'\',\'acknowledged\')">Acknowledge</button><button class="btn-sm flex-1" onclick="updateRequestStatus(\''+r.id+'\',\'converted\')">Convert</button><button class="btn-danger flex-1" onclick="updateRequestStatus(\''+r.id+'\',\'rejected\')">Reject</button>';}
  else if(r.status==='acknowledged'){actions+='<button class="btn-sm flex-1" onclick="updateRequestStatus(\''+r.id+'\',\'converted\')">Convert to order</button>';}
  document.getElementById('req-detail-actions').innerHTML=actions;
  openSheet('sh-request-detail');
}
function updateRequestStatus(id,status){
  var r=orderRequests.find(function(x){return x.id===id;});
  if(r){r.status=status;}
  closeSheet('sh-request-detail');
  renderOrderRequests(_reqFilter);
  showToast('Status updated to '+status);
}

// ==================== SETTINGS ====================
function renderOptionSets(){
  var html='';
  if(!optionSets.length)html='<div class="tx3 text-center" style="padding:16px;">No option sets</div>';
  optionSets.forEach(function(os,i){
    html+='<div class="opt-row"><div class="opt-info"><div class="opt-name">'+esc(os.name)+'</div><div class="opt-vals">'+esc(os.values.join(', '))+'</div></div>';
    html+='<div style="display:flex;gap:6px;"><button class="btn-sm" onclick="editOptionSet(\''+os.id+'\')">Edit</button><button class="btn-danger" onclick="deleteOptionSet(\''+os.id+'\')">Del</button></div></div>';
  });
  document.getElementById('option-sets-list').innerHTML=html;
}
function openNewOptionSet(){window._editingOsId=null;document.getElementById('os-title').textContent='New Option Set';document.getElementById('os-name').value='';document.getElementById('os-vals').value='';openSheet('sh-optset');}
function editOptionSet(id){var os=optionSets.find(function(x){return x.id===id;});if(!os)return;window._editingOsId=id;document.getElementById('os-title').textContent='Edit Option Set';document.getElementById('os-name').value=os.name;document.getElementById('os-vals').value=os.values.join(', ');openSheet('sh-optset');}
function doSaveOptionSet(){
  var name=document.getElementById('os-name').value.trim();if(!name){showToast('Enter a name','error');return;}
  var vals=document.getElementById('os-vals').value.split(',').map(function(v){return v.trim();}).filter(Boolean);
  if(window._editingOsId){var os=optionSets.find(function(x){return x.id===window._editingOsId;});if(os){os.name=name;os.values=vals;}}
  else{optionSets.push({id:uuid(),name:name,values:vals});}
  closeSheet('sh-optset');renderOptionSets();showToast('Option set saved');
}
function saveOptionSet(os){optionSets.push(os);}
function deleteOptionSet(id){if(confirm('Delete this option set?')){optionSets=optionSets.filter(function(x){return x.id!==id;});renderOptionSets();showToast('Deleted');}}

// ==================== INIT ====================
document.addEventListener('DOMContentLoaded',function(){
  renderViewsBar();
  renderList();
  // Handle sh-nav special: slide from right as a side drawer
  var nav=document.getElementById('sh-nav');
  nav.style.justifyContent='flex-end';
  // Keyboard back
  window.addEventListener('popstate',function(){goBack();});
});
</script>
</body>
</html>
