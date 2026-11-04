<?php
// BoutiqBiz — Materials Module v8
// Build date: 2026-11-02
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<title>Materials — BoutiqBiz</title>
<style>
:root{
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
/* CRITICAL: bottom sheets */
.sh-ov{display:none;position:fixed;inset:0;z-index:500;flex-direction:column;justify-content:flex-end;background:rgba(10,8,40,0.42);}
.sh-ov.open{display:flex;}
.sh{background:var(--sf);border-radius:20px 20px 0 0;padding:0 0 32px;max-height:92dvh;overflow-y:auto;}
.sh-handle{width:36px;height:4px;background:var(--br2);border-radius:2px;margin:12px auto 16px;}
.sh-hd{display:flex;align-items:center;justify-content:space-between;padding:0 16px 12px;}
.sh-hd h3{font-size:16px;font-weight:600;color:var(--tx);}
.sh-body{padding:0 16px;}
/* Topbar */
.tb{background:var(--p);color:#fff;display:flex;align-items:center;gap:8px;padding:20px 16px 14px;position:sticky;top:0;z-index:100;}
.tb h1{font-size:17px;font-weight:600;flex:1;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.tb .sub{font-size:12px;opacity:.8;display:block;}
.tb-bk{width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,.16);border:none;display:flex;align-items:center;justify-content:center;color:#fff;cursor:pointer;flex-shrink:0;}
.tb-act{background:rgba(255,255,255,.16);border:none;border-radius:8px;padding:6px 10px;color:#fff;cursor:pointer;font-size:13px;font-weight:500;display:flex;align-items:center;gap:4px;}
.tb-add{background:var(--g);border:none;border-radius:20px;padding:6px 14px;color:#fff;cursor:pointer;font-size:13px;font-weight:600;white-space:nowrap;}
/* Tab strip */
.tab-strip{background:var(--p);padding:0 16px 8px;overflow-x:auto;scrollbar-width:none;}
.tab-strip::-webkit-scrollbar{display:none;}
.tab-inner{display:flex;gap:4px;}
.tab{padding:6px 14px;border-radius:20px;font-size:13px;font-weight:500;color:rgba(255,255,255,.7);background:transparent;border:none;cursor:pointer;white-space:nowrap;}
.tab.on{background:#fff;color:var(--pt);}
/* Body */
.body{flex:1;padding:16px;display:flex;flex-direction:column;gap:12px;}
.card{background:var(--sf);border-radius:14px;padding:14px 16px;}
.card+.card{margin-top:0;}
.sect-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;}
.sect-hd h3{font-size:15px;font-weight:600;}
/* Forms */
input,select,textarea{background:var(--sf2);border:1.5px solid var(--br);border-radius:10px;padding:10px 12px;font-size:14px;color:var(--tx);width:100%;font-family:inherit;}
input:focus,select:focus,textarea:focus{outline:none;border-color:var(--p);}
label{font-size:12px;color:var(--tx2);font-weight:500;display:block;margin-bottom:4px;}
.fld{margin-bottom:12px;}
/* Buttons */
.btn-p{background:var(--p);color:#fff;border:none;border-radius:12px;padding:13px 20px;font-size:15px;font-weight:600;cursor:pointer;width:100%;display:flex;align-items:center;justify-content:center;gap:6px;}
.btn-g{background:var(--g);color:#fff;border:none;border-radius:12px;padding:13px 20px;font-size:15px;font-weight:600;cursor:pointer;width:100%;}
.btn-s{background:var(--sf);color:var(--p);border:1.5px solid var(--br2);border-radius:12px;padding:11px 20px;font-size:14px;font-weight:600;cursor:pointer;}
.btn-sm{background:var(--pl);color:var(--pt);border:none;border-radius:8px;padding:6px 12px;font-size:13px;font-weight:500;cursor:pointer;}
.btn-ghost{background:none;border:none;cursor:pointer;color:var(--tx2);display:inline-flex;align-items:center;gap:4px;font-size:13px;padding:4px;}
.btn-danger{background:var(--rl);color:var(--rt);border:none;border-radius:8px;padding:6px 12px;font-size:13px;cursor:pointer;}
.btn-icon{background:none;border:none;cursor:pointer;color:var(--tx3);padding:6px;display:inline-flex;align-items:center;justify-content:center;}
/* Chips & status */
.chip{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500;}
.chip-f{background:var(--pl);color:var(--pt);}
.chip-r{background:var(--al);color:var(--at);}
.chip-p{background:var(--bl);color:var(--bt);}
.chip-ok{background:var(--gl);color:var(--gt);}
.chip-low{background:var(--al);color:var(--at);}
.chip-out{background:var(--rl);color:var(--rt);}
.chip-draft{background:#f0f0f0;color:#666;}
.chip-active{background:var(--gl);color:var(--gt);}
.chip-paused{background:var(--al);color:var(--at);}
.chip-delisted{background:var(--rl);color:var(--rt);}
.dot{width:8px;height:8px;border-radius:50%;display:inline-block;flex-shrink:0;}
.dot-ok{background:var(--g);}
.dot-low{background:var(--a);}
.dot-out{background:var(--r);}
/* Rows */
.row{display:flex;align-items:center;gap:8px;}
.row-between{display:flex;align-items:center;justify-content:space-between;}
.gap-4{gap:4px;}.gap-8{gap:8px;}.gap-12{gap:12px;}
.mb-4{margin-bottom:4px;}.mb-8{margin-bottom:8px;}.mb-12{margin-bottom:12px;}
.fw-6{font-weight:600;}.fs-12{font-size:12px;}.fs-13{font-size:13px;}.fs-15{font-size:15px;}.fs-16{font-size:16px;}
.tx2{color:var(--tx2);}.tx3{color:var(--tx3);}
.text-center{text-align:center;}
.flex-1{flex:1;}
/* Views bar */
.views-bar{background:var(--sf);border-bottom:1px solid var(--br);padding:8px 16px;overflow-x:auto;scrollbar-width:none;display:flex;gap:6px;}
.views-bar::-webkit-scrollbar{display:none;}
.view-pill{padding:5px 14px;border-radius:20px;font-size:13px;font-weight:500;cursor:pointer;white-space:nowrap;border:1.5px solid var(--br);background:var(--sf);color:var(--tx2);}
.view-pill.on{background:var(--p);color:#fff;border-color:var(--p);}
.view-pill.add{border-style:dashed;color:var(--tx3);}
/* Material list rows */
.mat-row{background:var(--sf);border-bottom:1px solid var(--br);padding:12px 16px;display:flex;align-items:center;gap:10px;cursor:pointer;}
.mat-row:active{background:var(--sf2);}
.mat-info{flex:1;min-width:0;}
.mat-name{font-size:14px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.mat-meta{font-size:12px;color:var(--tx2);margin-top:2px;}
.mat-right{display:flex;align-items:center;gap:8px;flex-shrink:0;}
.mat-qty{font-size:14px;font-weight:600;}
/* Var rows */
.var-row{display:flex;align-items:center;gap:8px;padding:10px 0;border-bottom:1px solid var(--br);}
.var-row:last-child{border-bottom:none;}
.var-swatch{width:20px;height:20px;border-radius:50%;flex-shrink:0;border:1.5px solid rgba(0,0,0,.1);}
.var-info{flex:1;min-width:0;}
.var-name{font-size:13px;font-weight:600;}
.var-sku{font-size:12px;color:var(--tx2);}
.var-actions{display:flex;gap:6px;}
/* Controls */
.ctrl-row{display:flex;align-items:center;gap:8px;padding:10px 16px;background:var(--sf);border-bottom:1px solid var(--br);}
.ctrl-row input{flex:1;}
.ctrl-btn{background:none;border:1.5px solid var(--br);border-radius:10px;padding:8px 10px;color:var(--tx2);cursor:pointer;display:flex;align-items:center;gap:4px;font-size:13px;white-space:nowrap;}
/* Material action bar */
.mat-action-bar{background:var(--sf);border-bottom:1px solid var(--br);padding:12px 16px;display:flex;flex-direction:column;gap:10px;}
.stock-pill-row{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
.stock-pill{display:inline-flex;align-items:center;gap:6px;padding:7px 16px;border-radius:20px;font-size:16px;font-weight:700;}
.stock-pill.ok{background:var(--gl);color:var(--gt);}
.stock-pill.low{background:var(--al);color:var(--at);}
.stock-pill.out{background:var(--rl);color:var(--rt);}
.alert-pill{display:inline-flex;align-items:center;gap:4px;padding:5px 10px;border-radius:20px;font-size:12px;font-weight:500;background:var(--al);color:var(--at);}
.action-row{display:flex;gap:8px;flex-wrap:wrap;}
.action-btn{background:var(--sf2);border:1.5px solid var(--br);border-radius:10px;padding:8px 14px;font-size:13px;font-weight:500;color:var(--tx);cursor:pointer;display:inline-flex;align-items:center;gap:6px;}
/* Location rows */
.loc-section{margin-bottom:8px;}
.loc-section-hd{font-size:12px;font-weight:600;color:var(--tx2);margin-bottom:4px;display:flex;align-items:center;justify-content:space-between;}
.loc-row{display:flex;align-items:center;justify-content:space-between;padding:6px 0;border-bottom:1px solid var(--br);}
.loc-row:last-child{border-bottom:none;}
/* Movement rows */
.mov-row{display:flex;align-items:flex-start;justify-content:space-between;padding:10px 0;border-bottom:1px solid var(--br);}
.mov-row:last-child{border-bottom:none;}
.mov-type{font-size:13px;font-weight:600;}
.mov-meta{font-size:12px;color:var(--tx2);}
.mov-qty{font-size:14px;font-weight:600;}
.mov-qty.in{color:var(--g);}
.mov-qty.out{color:var(--r);}
/* Divider */
.divider{height:1px;background:var(--br);margin:8px 0;}
/* SVG chart */
.chart-wrap{background:var(--sf2);border-radius:10px;padding:8px;overflow:hidden;}
/* Stat tiles */
.stat-row{display:flex;gap:8px;}
.stat-tile{flex:1;background:var(--sf2);border-radius:12px;padding:10px 12px;text-align:center;}
.stat-val{font-size:18px;font-weight:700;color:var(--tx);}
.stat-lbl{font-size:11px;color:var(--tx3);margin-top:2px;}
/* Labels */
.design-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.design-card{background:var(--sf2);border-radius:12px;padding:12px;border:1.5px solid var(--br);}
.design-card-name{font-size:13px;font-weight:600;margin-bottom:4px;}
.design-card-meta{font-size:12px;color:var(--tx2);margin-bottom:8px;}
.design-card-acts{display:flex;gap:6px;}
.label-prev{background:white;border:1px solid var(--br);border-radius:8px;padding:12px;margin:12px 0;font-size:12px;}
.queue-row{display:flex;align-items:center;gap:8px;padding:10px 0;border-bottom:1px solid var(--br);}
/* Collections */
.col-card{background:var(--sf);border-radius:14px;padding:14px 16px;margin-bottom:10px;cursor:pointer;}
.col-card:active{background:var(--sf2);}
.col-card-hd{display:flex;align-items:center;gap:10px;margin-bottom:8px;}
.col-dot{width:12px;height:12px;border-radius:50%;flex-shrink:0;}
.col-thumbs{display:flex;gap:6px;}
.col-thumb{width:40px;height:40px;border-radius:8px;background:var(--sf2);border:1px solid var(--br);}
/* Order requests */
.req-row{background:var(--sf);padding:12px 16px;border-bottom:1px solid var(--br);cursor:pointer;}
.req-row:active{background:var(--sf2);}
/* Listings */
.listing-card{background:var(--sf);border-radius:14px;padding:14px 16px;margin-bottom:10px;cursor:pointer;}
.listing-card:active{background:var(--sf2);}
.ch-chip{display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:500;border:1.5px solid var(--br);cursor:pointer;}
.ch-chip.on{border-color:var(--p);background:var(--pl);color:var(--pt);}
.bullet-row{display:flex;align-items:flex-start;gap:8px;margin-bottom:6px;}
.bullet-row input{flex:1;}
/* BOM */
.bom-row{display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--br);}
.bom-row:last-child{border-bottom:none;}
.inherited-tag{font-size:11px;background:var(--sf2);color:var(--tx3);padding:2px 6px;border-radius:4px;border:1px solid var(--br);}
/* Nav items */
.nav-item{display:flex;align-items:center;gap:12px;padding:14px 16px;cursor:pointer;border-radius:10px;margin:2px 0;}
.nav-item:hover,.nav-item:active{background:var(--sf2);}
.nav-item-label{font-size:15px;font-weight:500;}
/* Switch toggle */
.sw{position:relative;width:44px;height:24px;flex-shrink:0;}
.sw input{opacity:0;width:0;height:0;position:absolute;}
.sw-sl{position:absolute;cursor:pointer;inset:0;background:var(--br2);border-radius:12px;transition:.2s;}
.sw input:checked+.sw-sl{background:var(--p);}
.sw-sl:before{content:'';position:absolute;width:18px;height:18px;left:3px;bottom:3px;background:#fff;border-radius:50%;transition:.2s;}
.sw input:checked+.sw-sl:before{transform:translateX(20px);}
/* Stepper */
.stepper{display:flex;align-items:center;gap:0;}
.stepper button{width:36px;height:36px;border:1.5px solid var(--br);background:var(--sf);cursor:pointer;font-size:18px;color:var(--tx2);display:flex;align-items:center;justify-content:center;}
.stepper button:first-child{border-radius:8px 0 0 8px;}
.stepper button:last-child{border-radius:0 8px 8px 0;}
.stepper span{width:48px;height:36px;border-top:1.5px solid var(--br);border-bottom:1.5px solid var(--br);display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:600;}
/* Settings option set */
.oset-row{display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid var(--br);}
/* Toast */
#toast{position:fixed;bottom:24px;left:50%;transform:translateX(-50%);padding:10px 18px;border-radius:24px;font-size:14px;z-index:9999;display:none;white-space:nowrap;box-shadow:0 4px 20px rgba(0,0,0,.3);color:#fff;pointer-events:none;}
/* Empty states */
.empty{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:48px 24px;text-align:center;gap:10px;}
.empty-icon{font-size:40px;opacity:.4;}
.empty-msg{color:var(--tx3);font-size:14px;}
/* Mat In/Out items */
.mi-item{background:var(--sf2);border-radius:10px;padding:10px 12px;margin-bottom:8px;position:relative;}
.mi-item-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;}
.mi-item-name{font-size:13px;font-weight:600;}
.mi-item-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;}
/* GST row */
.gst-row{display:flex;align-items:center;gap:12px;padding:10px 0;}
/* Summary rows */
.sum-row{display:flex;align-items:center;justify-content:space-between;padding:8px 0;font-size:14px;}
.sum-row.total{font-weight:700;font-size:16px;border-top:2px solid var(--br);margin-top:4px;padding-top:12px;}
/* Costing */
.cost-row{display:flex;align-items:center;gap:8px;padding:6px 0;border-bottom:1px solid var(--br);}
.cost-row:last-child{border-bottom:none;}
</style>
</head>
<body>

<!-- ===== SCREENS ===== -->

<!-- s-list: Material List -->
<div id="s-list" class="screen on">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')" aria-label="Menu">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Materials</h1>
    <button class="tb-act" onclick="openSheet('sh-cols')" aria-label="Columns">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="18"/><rect x="14" y="3" width="7" height="18"/></svg>
    </button>
    <button class="tb-add" onclick="openCreate(null)">+ Add</button>
  </div>
  <div class="views-bar" id="views-bar"></div>
  <div class="ctrl-row">
    <input type="search" id="list-search" placeholder="Search materials…" oninput="renderList()">
    <button class="ctrl-btn" onclick="openSheet('sh-sort')">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="6" y1="12" x2="18" y2="12"/><line x1="9" y1="18" x2="15" y2="18"/></svg>Sort
    </button>
    <button class="ctrl-btn" onclick="openSheet('sh-filter')">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>Filter
    </button>
  </div>
  <div id="list-meta" style="padding:8px 16px;font-size:12px;color:var(--tx3);"></div>
  <div id="list-body" style="flex:1;"></div>
</div>

<!-- s-mat-in: Material In -->
<div id="s-mat-in" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1>Material In</h1>
    <button class="tb-act" onclick="saveMatIn()">Save</button>
  </div>
  <div class="body">
    <div class="card">
      <div class="fld"><label>Entry No.</label><input type="text" id="mi-entryno" readonly></div>
      <div class="fld"><label>Date</label><input type="date" id="mi-date"></div>
      <div class="fld"><label>Type</label>
        <select id="mi-type">
          <option value="purchase">Purchase</option>
          <option value="return-jobber">Return from Jobber</option>
          <option value="return-customer">Return from Customer</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div class="fld"><label>Vendor</label><input type="text" id="mi-vendor" placeholder="Vendor name"></div>
      <div class="fld"><label>Invoice Ref</label><input type="text" id="mi-invoice" placeholder="Invoice number"></div>
      <div class="fld"><label>Notes</label><textarea id="mi-notes" rows="2" placeholder="Optional notes"></textarea></div>
    </div>
    <div class="card">
      <div class="sect-hd"><h3>Items</h3><button class="btn-sm" onclick="addMatInItem()">+ Add item</button></div>
      <div id="mi-items"></div>
      <div style="margin-top:12px;border-top:1px solid var(--br);padding-top:12px;">
        <div class="sum-row"><span class="tx2">Subtotal</span><span id="mi-subtotal">₹0</span></div>
        <div class="gst-row">
          <label class="sw"><input type="checkbox" id="mi-gst" onchange="calcMiTotal()"><span class="sw-sl"></span></label>
          <span style="flex:1;font-size:13px;">GST</span>
          <input type="number" id="mi-gstpct" value="12" style="width:60px;" onchange="calcMiTotal()" placeholder="%">
          <span class="tx2" style="font-size:13px;">%</span>
        </div>
        <div class="sum-row total"><span>Grand Total</span><span id="mi-total" style="color:var(--p);">₹0</span></div>
      </div>
    </div>
    <button class="btn-p" onclick="saveMatIn()">Save Entry</button>
  </div>
</div>

<!-- s-mat-out: Material Out -->
<div id="s-mat-out" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1>Material Out</h1>
    <button class="tb-act" onclick="saveMatOut()">Save</button>
  </div>
  <div class="body">
    <div class="card">
      <div class="fld"><label>Entry No.</label><input type="text" id="mo-entryno" readonly></div>
      <div class="fld"><label>Date</label><input type="date" id="mo-date"></div>
      <div class="fld"><label>Out Type</label>
        <select id="mo-type" onchange="renderMoRecipient()">
          <option value="jobber">To Jobber</option>
          <option value="customer">To Customer</option>
          <option value="sales">Sales / Despatch</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div id="mo-recipient-fields"></div>
      <div class="fld"><label>Notes</label><textarea id="mo-notes" rows="2" placeholder="Optional notes"></textarea></div>
    </div>
    <div class="card">
      <div class="sect-hd"><h3>Items</h3><button class="btn-sm" onclick="addMatOutItem()">+ Add item</button></div>
      <div id="mo-items"></div>
      <div style="margin-top:12px;border-top:1px solid var(--br);padding-top:12px;">
        <div class="sum-row total"><span>Total</span><span id="mo-total" style="color:var(--p);">₹0</span></div>
      </div>
    </div>
    <button class="btn-p" onclick="saveMatOut()">Save Entry</button>
  </div>
</div>

<!-- s-create: Create/Edit Material -->
<div id="s-create" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1 id="create-title">New Material</h1>
    <button class="tb-act" onclick="saveCreate()">Save</button>
  </div>
  <div class="tab-strip"><div class="tab-inner">
    <button class="tab on" onclick="setCTab(0)">Info</button>
    <button class="tab" onclick="setCTab(1)">Variants</button>
    <button class="tab" onclick="setCTab(2)">Movement</button>
  </div></div>
  <div id="ct-0" class="body"></div>
  <div id="ct-1" class="body" style="display:none;"></div>
  <div id="ct-2" class="body" style="display:none;"></div>
</div>

<!-- s-vdetail: Variant Detail -->
<div id="s-vdetail" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <div style="flex:1;min-width:0;"><h1 id="vd-title">Variant</h1></div>
    <button class="tb-act" onclick="saveVDetail()">Save</button>
  </div>
  <div class="tab-strip"><div class="tab-inner">
    <button class="tab on" onclick="setVTab(0)">Pricing</button>
    <button class="tab" onclick="setVTab(1)">Inventory</button>
    <button class="tab" onclick="setVTab(2)">BOM & TechPack</button>
    <button class="tab" onclick="setVTab(3)">Costing</button>
    <button class="tab" onclick="setVTab(4)">Production</button>
  </div></div>
  <div id="vt-0" class="body"></div>
  <div id="vt-1" class="body" style="display:none;"></div>
  <div id="vt-2" class="body" style="display:none;"></div>
  <div id="vt-3" class="body" style="display:none;"></div>
  <div id="vt-4" class="body" style="display:none;"></div>
</div>

<!-- s-mdetail: Material Detail -->
<div id="s-mdetail" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <div style="flex:1;min-width:0;"><h1 id="md-title">Material</h1></div>
    <button class="tb-act" onclick="openSheet('sh-mat-actions')">More</button>
    <button class="tb-act" onclick="editCurrentMat()">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>Edit
    </button>
  </div>
  <div class="mat-action-bar" id="md-action-bar"></div>
  <div class="tab-strip"><div class="tab-inner">
    <button class="tab on" onclick="setMTab(0)">Variants</button>
    <button class="tab" onclick="setMTab(1)">Supply</button>
    <button class="tab" onclick="setMTab(2)">Production</button>
    <button class="tab" onclick="setMTab(3)">Listings</button>
    <button class="tab" onclick="setMTab(4)">Collections</button>
  </div></div>
  <div id="mt-0" class="body"></div>
  <div id="mt-1" class="body" style="display:none;"></div>
  <div id="mt-2" class="body" style="display:none;"></div>
  <div id="mt-3" class="body" style="display:none;"></div>
  <div id="mt-4" class="body" style="display:none;"></div>
</div>

<!-- s-labels: Print Labels -->
<div id="s-labels" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Print Labels</h1>
  </div>
  <div class="tab-strip"><div class="tab-inner">
    <button class="tab on" onclick="setLTab(0)">Designs</button>
    <button class="tab" onclick="setLTab(1)" id="l-tab-queue">Queue</button>
  </div></div>
  <div id="lt-0" class="body"></div>
  <div id="lt-1" class="body" style="display:none;"></div>
</div>

<!-- s-label-preview: Label Preview -->
<div id="s-label-preview" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1>Label Preview</h1>
    <button class="tb-act" onclick="doPrint()">🖨 Print</button>
  </div>
  <div class="body">
    <div id="lp-label" style="display:flex;justify-content:center;padding:24px 0;"></div>
    <div class="card">
      <div class="fld"><label>Printer</label><select><option>Default Printer</option><option>Label Printer 1</option></select></div>
      <div class="fld">
        <label>Quantity</label>
        <div class="stepper">
          <button onclick="lpQtyAdj(-1)">−</button>
          <span id="lp-qty">1</span>
          <button onclick="lpQtyAdj(1)">+</button>
        </div>
      </div>
    </div>
    <button class="btn-p" onclick="doPrint()">🖨 Print Labels</button>
  </div>
</div>

<!-- s-collections: Collections -->
<div id="s-collections" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Collections</h1>
    <button class="tb-add" onclick="openNewCollection()">+ New</button>
  </div>
  <div class="body" id="collections-body"></div>
</div>

<!-- s-cdetail: Collection Detail -->
<div id="s-cdetail" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1 id="cd-title">Collection</h1>
    <button class="tb-act" onclick="openSheet('sh-sharelink')">Share</button>
    <button class="tb-act" onclick="editCurrentCollection()">Edit</button>
  </div>
  <div class="body" id="cdetail-body"></div>
</div>

<!-- s-listings: Channel Listings -->
<div id="s-listings" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Channel Listings</h1>
    <button class="tb-add" onclick="openListingDetail(null)">+ New</button>
  </div>
  <div style="padding:10px 16px;overflow-x:auto;display:flex;gap:6px;scrollbar-width:none;background:var(--sf);border-bottom:1px solid var(--br);" id="ch-filter-row"></div>
  <div class="body" id="listings-body"></div>
</div>

<!-- s-listing-detail: Create/Edit Listing -->
<div id="s-listing-detail" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <h1 id="ld-title">New Listing</h1>
    <button class="tb-add" onclick="saveListing(true)">Publish</button>
  </div>
  <div class="body" id="listing-detail-body"></div>
</div>

<!-- s-order-requests: Client Order Requests -->
<div id="s-order-requests" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Order Requests</h1>
  </div>
  <div style="display:flex;gap:6px;padding:10px 16px;overflow-x:auto;background:var(--sf);border-bottom:1px solid var(--br);">
    <button class="btn-sm" onclick="renderOrderRequests('')" id="or-all">All</button>
    <button class="btn-sm" onclick="renderOrderRequests('pending')">Pending</button>
    <button class="btn-sm" onclick="renderOrderRequests('acknowledged')">Acknowledged</button>
    <button class="btn-sm" onclick="renderOrderRequests('converted')">Converted</button>
    <button class="btn-sm" onclick="renderOrderRequests('rejected')">Rejected</button>
  </div>
  <div id="or-body" style="flex:1;"></div>
</div>

<!-- s-sync: Sync Inventory -->
<div id="s-sync" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Sync Inventory</h1>
  </div>
  <div class="body">
    <div class="card">
      <div class="sect-hd"><h3>CSV Import / Export</h3></div>
      <button class="btn-s" style="margin-bottom:10px;" onclick="showToast('Template downloaded','info')">⬇ Download CSV Template</button>
      <div class="fld"><label>Upload CSV</label><input type="file" accept=".csv"></div>
      <button class="btn-p" onclick="showToast('Preview coming soon','info')">Preview & Apply</button>
    </div>
    <div class="card">
      <div class="sect-hd"><h3>Shopify Sync</h3></div>
      <p style="color:var(--tx2);font-size:13px;margin-bottom:12px;">Connect your Shopify store to sync inventory levels automatically.</p>
      <button class="btn-p" onclick="showToast('Connect Shopify — coming soon','info')">Connect Shopify</button>
    </div>
  </div>
</div>

<!-- s-settings: Settings -->
<div id="s-settings" class="screen">
  <div class="tb">
    <button class="tb-bk" onclick="openSheet('sh-nav')">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <h1>Settings</h1>
  </div>
  <div class="body">
    <div class="card">
      <div class="sect-hd"><h3>Option Sets</h3><button class="btn-sm" onclick="openNewOptionSet()">+ New</button></div>
      <div id="oset-list"></div>
    </div>
  </div>
</div>


<!-- ===== BOTTOM SHEETS ===== -->

<!-- sh-nav: Navigation -->
<div id="sh-nav" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-nav')">
  <div class="sh" style="border-radius:0;width:280px;margin:0 auto 0 0;height:100dvh;max-height:100dvh;">
    <div style="background:var(--p);padding:32px 20px 20px;color:#fff;">
      <div style="font-size:11px;opacity:.7;margin-bottom:2px;">BoutiqBiz</div>
      <div style="font-size:18px;font-weight:700;">Demo Store</div>
    </div>
    <div style="padding:12px 8px;">
      <div class="nav-item" onclick="navTo('s-list')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="6" height="6"/><rect x="9" y="3" width="6" height="6"/><rect x="16" y="3" width="6" height="6"/><rect x="2" y="11" width="6" height="6"/><rect x="9" y="11" width="6" height="6"/><rect x="16" y="11" width="6" height="6"/></svg>
        <span class="nav-item-label">Materials</span>
      </div>
      <div class="nav-item" onclick="navTo('s-mat-in')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
        <span class="nav-item-label">Material In</span>
      </div>
      <div class="nav-item" onclick="navTo('s-mat-out')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
        <span class="nav-item-label">Material Out</span>
      </div>
      <div class="nav-item" onclick="navTo('s-collections')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        <span class="nav-item-label">Collections</span>
      </div>
      <div class="nav-item" onclick="navTo('s-listings')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        <span class="nav-item-label">Channel Listings</span>
      </div>
      <div class="nav-item" onclick="navTo('s-order-requests')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <span class="nav-item-label">Client Order Requests</span>
      </div>
      <div class="nav-item" onclick="navTo('s-labels')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
        <span class="nav-item-label">Print Labels</span>
      </div>
      <div class="nav-item" onclick="navTo('s-sync')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
        <span class="nav-item-label">Sync Inventory</span>
      </div>
      <div class="nav-item" onclick="navTo('s-settings')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
        <span class="nav-item-label">Settings</span>
      </div>
    </div>
  </div>
</div>

<!-- sh-filter: Filter -->
<div id="sh-filter" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-filter')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Filter</h3><button class="btn-ghost" onclick="clearFilter()">Clear</button></div>
    <div class="sh-body">
      <div class="fld"><label>Type</label>
        <select id="f-type"><option value="">All types</option><option value="finished">Finished</option><option value="raw">Raw</option><option value="production">Production</option></select>
      </div>
      <div class="fld"><label>Stock Status</label>
        <select id="f-stock"><option value="">Any</option><option value="ok">In Stock</option><option value="low">Low Stock</option><option value="out">Out of Stock</option></select>
      </div>
      <div class="fld"><label>Vendor</label><input type="text" id="f-vendor" placeholder="Vendor name"></div>
      <button class="btn-p" style="margin-top:4px;" onclick="applyFilter()">Apply Filter</button>
    </div>
  </div>
</div>

<!-- sh-sort: Sort -->
<div id="sh-sort" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-sort')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Sort By</h3></div>
    <div class="sh-body" id="sort-opts">
      <div style="display:flex;flex-direction:column;gap:4px;padding-bottom:16px;">
        <label style="display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--br);cursor:pointer;font-size:14px;"><input type="radio" name="sort-r" value="name-asc" checked> Name A–Z</label>
        <label style="display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--br);cursor:pointer;font-size:14px;"><input type="radio" name="sort-r" value="name-desc"> Name Z–A</label>
        <label style="display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--br);cursor:pointer;font-size:14px;"><input type="radio" name="sort-r" value="qty-desc"> Stock High–Low</label>
        <label style="display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--br);cursor:pointer;font-size:14px;"><input type="radio" name="sort-r" value="qty-asc"> Stock Low–High</label>
      </div>
      <button class="btn-p" onclick="applySort()">Apply</button>
    </div>
  </div>
</div>

<!-- sh-cols: Column Toggle -->
<div id="sh-cols" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-cols')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Columns</h3></div>
    <div class="sh-body" style="padding-bottom:16px;">
      <div id="cols-list" style="display:flex;flex-direction:column;gap:4px;margin-bottom:12px;"></div>
      <button class="btn-p" onclick="applyCols()">Apply</button>
    </div>
  </div>
</div>

<!-- sh-saveview: Save View -->
<div id="sh-saveview" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-saveview')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Save View</h3></div>
    <div class="sh-body">
      <div class="fld"><label>View Name</label><input type="text" id="sv-name" placeholder="e.g. High value finished goods"></div>
      <button class="btn-p" onclick="doSaveView()">Save View</button>
    </div>
  </div>
</div>

<!-- sh-move: Record Movement -->
<div id="sh-move" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-move')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Record Movement</h3></div>
    <div class="sh-body">
      <div class="fld"><label>Type</label>
        <select id="mv-type"><option value="Stock in">Stock In</option><option value="Stock out">Stock Out</option><option value="Transfer">Transfer</option><option value="Adjustment">Adjustment</option></select>
      </div>
      <div class="fld"><label>Quantity</label><input type="number" id="mv-qty" placeholder="0" min="0"></div>
      <div class="fld"><label>Rate (optional)</label><input type="number" id="mv-rate" placeholder="₹"></div>
      <div class="fld"><label>Reference</label><input type="text" id="mv-ref" placeholder="Invoice / order no."></div>
      <div class="fld"><label>Note</label><textarea id="mv-note" rows="2" placeholder="Optional note"></textarea></div>
      <div class="fld"><label>Date</label><input type="date" id="mv-date"></div>
      <button class="btn-p" onclick="saveMovement()">Save Movement</button>
    </div>
  </div>
</div>

<!-- sh-stockcount: Stock Count -->
<div id="sh-stockcount" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-stockcount')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Stock Count</h3></div>
    <div class="sh-body">
      <p class="tx2 fs-13 mb-12" id="sc-desc">Enter the actual physical quantity counted.</p>
      <div style="text-align:center;margin:16px 0;">
        <div class="tx3 fs-12 mb-4">System quantity</div>
        <div style="font-size:28px;font-weight:700;" id="sc-sysqty">0</div>
      </div>
      <div class="fld"><label>Physical Count</label><input type="number" id="sc-qty" placeholder="0" oninput="updateScPreview()"></div>
      <div id="sc-preview" style="margin:12px 0;padding:12px;border-radius:10px;background:var(--sf2);font-size:14px;text-align:center;display:none;"></div>
      <button class="btn-p" onclick="confirmStockCount()">Confirm Count</button>
    </div>
  </div>
</div>

<!-- sh-reserve: Add Reservation -->
<div id="sh-reserve" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-reserve')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Add Reservation</h3></div>
    <div class="sh-body">
      <div class="fld"><label>Order Ref</label><input type="text" id="res-order" placeholder="Order number"></div>
      <div class="fld"><label>Customer Name</label><input type="text" id="res-customer" placeholder="Customer name"></div>
      <div class="fld"><label>Quantity</label><input type="number" id="res-qty" placeholder="0" min="1"></div>
      <div class="fld"><label>Date</label><input type="date" id="res-date"></div>
      <button class="btn-p" onclick="saveReservation()">Add Reservation</button>
    </div>
  </div>
</div>

<!-- sh-bomline: BOM Line Editor -->
<div id="sh-bomline" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-bomline')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3 id="bl-title">Add BOM Line</h3></div>
    <div class="sh-body">
      <div class="fld"><label>Raw Material</label>
        <select id="bl-mat" onchange="updateBlVariants()">
          <option value="">Select material…</option>
        </select>
      </div>
      <div class="fld"><label>Variant (optional)</label>
        <select id="bl-var"><option value="">Any variant</option></select>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;" class="mb-12">
        <div class="fld"><label>Quantity</label><input type="number" id="bl-qty" placeholder="0" step="0.01" min="0"></div>
        <div class="fld"><label>Unit</label>
          <select id="bl-unit"><option>metres</option><option>kg</option><option>pcs</option><option>sets</option><option>litres</option><option>grams</option><option>other</option></select>
        </div>
      </div>
      <div class="fld"><label>Note</label><input type="text" id="bl-note" placeholder="Optional note"></div>
      <button class="btn-p" onclick="saveBOMLine()">Save Line</button>
    </div>
  </div>
</div>

<!-- sh-labeldesign: Label Design Editor -->
<div id="sh-labeldesign" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-labeldesign')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Label Design</h3></div>
    <div class="sh-body">
      <div class="fld"><label>Design Name</label><input type="text" id="ld-name" placeholder="e.g. Standard Tag"></div>
      <div class="fld"><label>Size</label>
        <select id="ld-size"><option value="50x25">50×25 mm</option><option value="38x25">38×25 mm</option><option value="100x50">100×50 mm</option></select>
      </div>
      <div class="fld">
        <label>Fields to print</label>
        <div style="display:flex;flex-direction:column;gap:6px;margin-top:6px;">
          <label style="display:flex;align-items:center;gap:8px;font-size:14px;color:var(--tx);font-weight:400;"><input type="checkbox" id="ld-f-name" checked> Product Name</label>
          <label style="display:flex;align-items:center;gap:8px;font-size:14px;color:var(--tx);font-weight:400;"><input type="checkbox" id="ld-f-var" checked> Variant</label>
          <label style="display:flex;align-items:center;gap:8px;font-size:14px;color:var(--tx);font-weight:400;"><input type="checkbox" id="ld-f-mrp" checked> MRP</label>
          <label style="display:flex;align-items:center;gap:8px;font-size:14px;color:var(--tx);font-weight:400;"><input type="checkbox" id="ld-f-offer"> Offer Price</label>
          <label style="display:flex;align-items:center;gap:8px;font-size:14px;color:var(--tx);font-weight:400;"><input type="checkbox" id="ld-f-sku"> SKU</label>
          <label style="display:flex;align-items:center;gap:8px;font-size:14px;color:var(--tx);font-weight:400;"><input type="checkbox" id="ld-f-barcode"> Barcode</label>
          <label style="display:flex;align-items:center;gap:8px;font-size:14px;color:var(--tx);font-weight:400;"><input type="checkbox" id="ld-f-design"> Design No.</label>
        </div>
      </div>
      <button class="btn-p" onclick="saveLabelDesign()">Save Design</button>
    </div>
  </div>
</div>

<!-- sh-addlabel: Add to Label Queue -->
<div id="sh-addlabel" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-addlabel')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Add to Queue</h3></div>
    <div class="sh-body">
      <div id="al-info" style="background:var(--sf2);border-radius:10px;padding:10px 12px;margin-bottom:12px;font-size:13px;"></div>
      <div class="fld"><label>Select Design</label><div id="al-designs" style="display:flex;flex-direction:column;gap:6px;margin-top:6px;"></div></div>
      <div class="fld"><label>Quantity</label>
        <div class="stepper"><button onclick="alQtyAdj(-1)">−</button><span id="al-qty">1</span><button onclick="alQtyAdj(1)">+</button></div>
      </div>
      <button class="btn-p" onclick="addToQueueConfirm()">Add to Queue</button>
    </div>
  </div>
</div>

<!-- sh-matitem: Material/Variant Picker -->
<div id="sh-matitem" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-matitem')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Select Item</h3></div>
    <div class="sh-body">
      <div class="fld"><input type="search" id="mi-search" placeholder="Search materials…" oninput="renderMatItemPicker()"></div>
      <div id="mi-picker-list" style="max-height:50dvh;overflow-y:auto;"></div>
    </div>
  </div>
</div>

<!-- sh-newcol: New/Edit Collection -->
<div id="sh-newcol" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-newcol')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3 id="nc-title">New Collection</h3></div>
    <div class="sh-body">
      <div class="fld"><label>Name</label><input type="text" id="nc-name" placeholder="Collection name"></div>
      <div class="fld"><label>Description</label><textarea id="nc-desc" rows="2" placeholder="Optional description"></textarea></div>
      <div class="fld">
        <label>Visibility</label>
        <div style="display:flex;gap:8px;margin-top:6px;">
          <button id="nc-vis-private" class="chip on" onclick="setColVisibility('private')" style="flex:1;">🔒 Private</button>
          <button id="nc-vis-public" class="chip" onclick="setColVisibility('public')" style="flex:1;">🌐 Public</button>
        </div>
        <input type="hidden" id="nc-visibility" value="private">
      </div>
      <button class="btn-p" onclick="saveCollection()">Save Collection</button>
    </div>
  </div>
</div>

<!-- sh-sharelink: Preview Link Settings -->
<div id="sh-sharelink" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-sharelink')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Share Settings</h3></div>
    <div class="sh-body">
      <div class="row-between mb-12">
        <div><div class="fs-14 fw-6">Enable share link</div><div class="tx3 fs-12">Anyone with the link can view this collection</div></div>
        <label class="sw"><input type="checkbox" id="sl-enabled" onchange="slToggle()"><span class="sw-sl"></span></label>
      </div>
      <div id="sl-link-section" style="display:none;">
        <div class="fld"><label>Share URL</label>
          <div style="display:flex;gap:6px;align-items:center;">
            <input type="text" id="sl-url" readonly style="flex:1;font-size:12px;color:var(--tx2);">
            <button class="btn-sm" onclick="copyShareLink()">Copy</button>
          </div>
        </div>
        <div class="fld"><label>Expiry Date <span class="tx3" style="font-weight:400;">(optional)</span></label>
          <input type="date" id="sl-expiry">
          <div class="tx3 fs-12" style="margin-top:4px;">If set, the link will show an expiry message after this date.</div>
        </div>
        <button class="btn-s" onclick="slRegenerate()" style="width:100%;margin-bottom:8px;">↻ Regenerate link</button>
      </div>
      <button class="btn-p" onclick="saveShareLink()">Save Settings</button>
    </div>
  </div>
</div>

<!-- sh-col-product-picker: Add Products to Collection -->
<div id="sh-col-product-picker" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-col-product-picker')">
  <div class="sh" style="max-height:85dvh;">
    <div class="sh-handle"></div>
    <div class="sh-hd">
      <h3>Add Products</h3>
      <button class="btn-sm btn-p-sm" onclick="doneAddingProducts()">Done</button>
    </div>
    <div class="sh-body" style="padding-top:0;">
      <input type="text" placeholder="Search by name or SKU…" oninput="colPickerSearch(this.value)" style="margin-bottom:10px;">
      <div id="cppicker-filters" style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:10px;">
        <button class="chip on" data-f="all" onclick="colPickerFilter('all')">All</button>
        <button class="chip" data-f="low" onclick="colPickerFilter('low')">Low stock</button>
        <button class="chip" data-f="out" onclick="colPickerFilter('out')">Out of stock</button>
        <button class="chip" data-f="finished" onclick="colPickerFilter('finished')">Finished</button>
        <button class="chip" data-f="raw" onclick="colPickerFilter('raw')">Raw</button>
        <button class="chip" data-f="added" onclick="colPickerFilter('added')">Already added</button>
      </div>
      <div id="cppicker-list" style="overflow-y:auto;max-height:52dvh;"></div>
    </div>
  </div>
</div>

<!-- sh-mat-actions: Material More Actions -->
<div id="sh-mat-actions" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-mat-actions')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Actions</h3></div>
    <div class="sh-body" style="padding-bottom:16px;">
      <div class="nav-item" onclick="addCurrentMatToCollection()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        <span class="nav-item-label">Add to Collection</span>
      </div>
      <div class="nav-item" onclick="addCurrentMatToListing()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10"/></svg>
        <span class="nav-item-label">Create Channel Listing</span>
      </div>
      <div class="nav-item" onclick="duplicateCurrentMat()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        <span class="nav-item-label">Duplicate Material</span>
      </div>
      <div class="nav-item" style="color:var(--r);" onclick="deleteCurrentMat()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
        <span class="nav-item-label" style="color:var(--r);">Delete Material</span>
      </div>
    </div>
  </div>
</div>

<!-- sh-request-detail: Order Request Detail -->
<div id="sh-request-detail" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-request-detail')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3>Order Request</h3></div>
    <div class="sh-body" id="rd-body"></div>
  </div>
</div>

<!-- sh-newset: Option Set Editor -->
<div id="sh-newset" class="sh-ov" onclick="if(event.target===this)closeSheet('sh-newset')">
  <div class="sh">
    <div class="sh-handle"></div>
    <div class="sh-hd"><h3 id="ns-title">New Option Set</h3></div>
    <div class="sh-body">
      <div class="fld"><label>Name</label><input type="text" id="ns-name" placeholder="e.g. Size, Colour"></div>
      <div class="fld"><label>Values (comma-separated)</label><input type="text" id="ns-values" placeholder="S, M, L, XL"></div>
      <button class="btn-p" onclick="saveOptionSet()">Save</button>
    </div>
  </div>
</div>

<!-- Toast -->
<div id="toast"></div>

<script>
// ===== DATA =====
var materials=[
  {id:1,name:'Cotton Kurta',type:'finished',sku:'CK-001',designNo:'D-001',unit:'pcs',
   vendors:[{name:'Ravi Textiles',type:'supplier',lead:'7 days',contact:'9876543210'}],
   imgs:[],desc:'Premium cotton kurta for women',notes:'',
   techpackUrl:'',techpackFile:'',externalLinks:[],
   bom:[{id:'b1',materialId:2,materialName:'Cotton Fabric',variantIdx:null,qty:1.2,unit:'metres',note:'',isVariantOverride:false}],
   cats:[{name:'Size',values:['S','M','L','XL']},{name:'Colour',values:['Red','Blue']}],
   collections:[],
   variants:[
     {name:'S / Red',sku:'CK-001-SR',mrp:1200,offer:999,cost:400,qty:15,barcode:'',minqty:5,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],
      bomOverrides:[{id:'bo1',materialId:2,materialName:'Cotton Fabric',variantIdx:null,qty:1.0,unit:'metres',note:'S size',isVariantOverride:true}],
      reservations:[{order:'ORD-001',customer:'Priya Singh',qty:2,status:'active',date:'2024-01-20'}],
      movements:[{date:'2024-01-15',type:'Stock in',subtype:'Purchase',qty:20,rate:400,ref:'INV-001',note:'Opening stock'}],
      inventory:{stores:[{loc:'VB Asansol',qty:10,color:'#4A3BB5'},{loc:'VB Durgapur',qty:5,color:'#1D9E75'}],jobbers:[],production:[],warehouse:[]}},
     {name:'M / Red',sku:'CK-001-MR',mrp:1200,offer:999,cost:420,qty:8,barcode:'',minqty:5,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],
      bomOverrides:[],reservations:[],movements:[],
      inventory:{stores:[{loc:'VB Asansol',qty:8,color:'#4A3BB5'}],jobbers:[],production:[],warehouse:[]}},
     {name:'L / Blue',sku:'CK-001-LB',mrp:1200,offer:999,cost:440,qty:3,barcode:'',minqty:5,color:'#185FA5',tags:[],images:[],notes:'',costLines:[],
      bomOverrides:[],reservations:[],movements:[],
      inventory:{stores:[{loc:'VB Asansol',qty:3,color:'#4A3BB5'}],jobbers:[],production:[],warehouse:[]}}
   ]},
  {id:2,name:'Cotton Fabric',type:'raw',sku:'CF-001',designNo:'',unit:'metres',
   vendors:[{name:'Ravi Textiles',type:'supplier',lead:'3 days',contact:'9876543210'}],
   imgs:[],desc:'100% cotton fabric',notes:'',
   techpackUrl:'',techpackFile:'',externalLinks:[],
   bom:[],cats:[{name:'Colour',values:['Red','Blue','White']}],collections:[],
   variants:[
     {name:'Red',sku:'CF-001-R',mrp:0,offer:0,cost:120,qty:45,barcode:'',minqty:10,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],
      bomOverrides:[],reservations:[],
      movements:[{date:'2024-01-10',type:'Stock in',subtype:'Purchase',qty:50,rate:120,ref:'INV-002',note:''}],
      inventory:{stores:[],jobbers:[],production:[{loc:'Main Store',qty:45,color:'#4A3BB5'}],warehouse:[]}},
     {name:'Blue',sku:'CF-001-B',mrp:0,offer:0,cost:120,qty:2,barcode:'',minqty:10,color:'#185FA5',tags:[],images:[],notes:'',costLines:[],
      bomOverrides:[],reservations:[],movements:[],
      inventory:{stores:[],jobbers:[],production:[{loc:'Main Store',qty:2,color:'#4A3BB5'}],warehouse:[]}}
   ]}
];
var savedViews=[
  {id:'v-all',name:'All',isSystem:true,filters:{},columns:['name','sku','type','variants','stock'],sort:{field:'name',dir:'asc'},viewMode:'list'},
  {id:'v-low',name:'Low Stock',isSystem:true,filters:{stockStatus:'low'},columns:['name','sku','stock','minqty'],sort:{field:'name',dir:'asc'},viewMode:'list'},
  {id:'v-out',name:'Out of Stock',isSystem:true,filters:{stockStatus:'out'},columns:['name','sku','stock'],sort:{field:'name',dir:'asc'},viewMode:'list'},
  {id:'v-fin',name:'Finished',isSystem:true,filters:{type:'finished'},columns:['name','sku','variants','stock','mrp'],sort:{field:'name',dir:'asc'},viewMode:'list'},
  {id:'v-raw',name:'Raw',isSystem:true,filters:{type:'raw'},columns:['name','sku','variants','stock','unit'],sort:{field:'name',dir:'asc'},viewMode:'list'},
  {id:'v-pro',name:'Production',isSystem:true,filters:{type:'production'},columns:['name','sku','variants','stock'],sort:{field:'name',dir:'asc'},viewMode:'list'}
];
var activeViewId='v-all';
var labelDesigns=[];
var labelQueue=[];
var collections=[];
var orderRequests=[
  {id:1,collectionId:null,matId:1,variantName:'M / Blue',clientName:'Rina Das',clientContact:'9800000001',requestDate:'2024-01-22',status:'pending'}
];
var optionSets=[
  {id:'os-1',name:'Size',values:['XS','S','M','L','XL','XXL']},
  {id:'os-2',name:'Colour',values:['Red','Blue','Green','Black','White']}
];
var matInEntries=[];
var matOutEntries=[];
var channels=[
  {id:'shopify',name:'Shopify',icon:'🛒',color:'#96BF48'},
  {id:'myntra',name:'Myntra',icon:'🔵',color:'#FF3E6C'},
  {id:'nykaa',name:'Nykaa Fashion',icon:'🌸',color:'#FC2779'},
  {id:'amazon',name:'Amazon Fashion',icon:'📦',color:'#FF9900'},
  {id:'ajio',name:'Ajio',icon:'⚡',color:'#1D1D1B'},
  {id:'website',name:'Own Website',icon:'🌐',color:'#185FA5'},
  {id:'whatsapp',name:'WhatsApp Catalog',icon:'💬',color:'#25D366'}
];
var channelListings=[];
// runtime state
var _screenStack=[];
var _editMatId=null;
var _editVi=null;
var _mdMatId=null;
var _editColId=null;
var _editListingId=null;
var _miItemTarget=null; // 'in' or 'out'
var _miItemIdx=null;
var _blTarget=null; // {matId, vi, isProductLevel}
var _alMatId=null,_alVi=null,_alQty=1;
var _lpMatId=null,_lpVi=null,_lpDesignId=null,_lpQty=1;
var _chFilter='';

// ===== UTILS =====
function esc(s){return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');}
function getMat(id){return materials.find(function(m){return m.id===id;});}
function totalStock(m){return m.variants.reduce(function(s,v){return s+v.qty;},0);}
function stockStatus(v){if(v.qty<=0)return 'out';if(v.minqty>0&&v.qty<=v.minqty)return 'low';return 'ok';}
function matStockStatus(m){var s=m.variants.map(stockStatus);if(s.every(function(x){return x==='out';}))return 'out';if(s.some(function(x){return x==='low'||x==='out';}))return 'low';return 'ok';}
function typeChipClass(t){return t==='finished'?'chip-f':t==='raw'?'chip-r':'chip-p';}
function todayStr(){return new Date().toISOString().slice(0,10);}
function uuid(){return Math.random().toString(36).slice(2,9);}
function nextId(arr){return arr.length?Math.max.apply(null,arr.map(function(x){return x.id||0;}))+1:1;}
function fmtMoney(n){return '₹'+(Number(n)||0).toLocaleString('en-IN');}
function showToast(msg,type){
  var t=document.getElementById('toast');
  t.textContent=msg;
  t.style.background=type==='error'?'#E24B4A':type==='info'?'#185FA5':'#1D9E75';
  t.style.display='block';
  clearTimeout(window._toastTimer);
  window._toastTimer=setTimeout(function(){t.style.display='none';},2400);
}

// ===== NAVIGATION =====
function showScreen(id){
  document.querySelectorAll('.screen').forEach(function(s){s.classList.remove('on');});
  var el=document.getElementById(id);
  if(el){el.classList.add('on');window.scrollTo(0,0);}
}
function pushScreen(id){
  var cur=document.querySelector('.screen.on');
  if(cur)_screenStack.push(cur.id);
  showScreen(id);
}
function goBack(){
  if(_screenStack.length){showScreen(_screenStack.pop());}
  else{showScreen('s-list');}
}
function navTo(id){
  closeSheet('sh-nav');
  _screenStack=[];
  if(id==='s-mat-in')initMatIn();
  else if(id==='s-mat-out')initMatOut();
  else if(id==='s-listings'){renderListings();renderChFilterRow();}
  else if(id==='s-collections')renderCollections();
  else if(id==='s-order-requests')renderOrderRequests('');
  else if(id==='s-labels')renderLabels();
  else if(id==='s-settings')renderOptionSets();
  showScreen(id);
}

// ===== SHEETS =====
function openSheet(id){
  var el=document.getElementById(id);
  if(el)el.classList.add('open');
}
function closeSheet(id){
  var el=document.getElementById(id);
  if(el)el.classList.remove('open');
}
function closeAllSheets(){
  document.querySelectorAll('.sh-ov').forEach(function(s){s.classList.remove('open');});
}

// ===== LIST =====
function renderViewsBar(){
  var bar=document.getElementById('views-bar');
  if(!bar)return;
  var html='';
  savedViews.forEach(function(v){
    html+='<button class="view-pill'+(v.id===activeViewId?' on':'')+'" onclick="setActiveView(\''+v.id+'\')" '+(v.isSystem?'':'oncontextmenu="viewCtx(\''+v.id+'\',event)"')+'>'+esc(v.name)+'</button>';
  });
  html+='<button class="view-pill add" onclick="openSheet(\'sh-saveview\')">+ New view</button>';
  bar.innerHTML=html;
}
function setActiveView(id){
  activeViewId=id;
  renderViewsBar();
  renderList();
}
function getActiveView(){return savedViews.find(function(v){return v.id===activeViewId;})||savedViews[0];}
function getFilteredMaterials(){
  var v=getActiveView();
  var q=(document.getElementById('list-search')||{}).value||'';
  return materials.filter(function(m){
    if(q&&m.name.toLowerCase().indexOf(q.toLowerCase())<0&&m.sku.toLowerCase().indexOf(q.toLowerCase())<0)return false;
    if(v.filters.type&&m.type!==v.filters.type)return false;
    if(v.filters.stockStatus){
      var st=matStockStatus(m);
      if(v.filters.stockStatus==='low'&&st!=='low')return false;
      if(v.filters.stockStatus==='out'&&st!=='out')return false;
      if(v.filters.stockStatus==='ok'&&st!=='ok')return false;
    }
    if(v.filters.vendor&&v.filters.vendor.trim()){
      var vn=v.filters.vendor.trim().toLowerCase();
      if(!m.vendors.some(function(vv){return vv.name.toLowerCase().indexOf(vn)>=0;}))return false;
    }
    return true;
  });
}
function renderList(){
  var arr=getFilteredMaterials();
  var meta=document.getElementById('list-meta');
  var body=document.getElementById('list-body');
  if(!body)return;
  var vars=arr.reduce(function(s,m){return s+m.variants.length;},0);
  if(meta)meta.textContent=arr.length+' materials · '+vars+' variants';
  if(!arr.length){
    body.innerHTML='<div class="empty"><div class="empty-icon">📦</div><div class="empty-msg">No materials match this view</div></div>';
    return;
  }
  var html='';
  arr.forEach(function(m){
    var ts=totalStock(m);
    var st=matStockStatus(m);
    html+='<div class="mat-row" onclick="openMDetail('+m.id+')">';
    html+='<div><span class="chip '+typeChipClass(m.type)+'" style="font-size:11px;">'+m.type.charAt(0).toUpperCase()+'</span></div>';
    html+='<div class="mat-info">';
    html+='<div class="mat-name">'+esc(m.name)+'</div>';
    html+='<div class="mat-meta">'+esc(m.sku)+' · '+m.variants.length+' variants</div>';
    html+='</div>';
    html+='<div class="mat-right">';
    html+='<span class="mat-qty">'+ts+' <span style="font-size:12px;color:var(--tx3);">'+esc(m.unit)+'</span></span>';
    html+='<span class="dot dot-'+st+'"></span>';
    html+='<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>';
    html+='</div></div>';
  });
  body.innerHTML=html;
}
function applyFilter(){
  var v=getActiveView();
  v.filters.type=document.getElementById('f-type').value||'';
  v.filters.stockStatus=document.getElementById('f-stock').value||'';
  v.filters.vendor=document.getElementById('f-vendor').value||'';
  closeSheet('sh-filter');
  renderList();
}
function clearFilter(){
  var v=getActiveView();v.filters={};
  document.getElementById('f-type').value='';
  document.getElementById('f-stock').value='';
  document.getElementById('f-vendor').value='';
  closeSheet('sh-filter');renderList();
}
function applySort(){
  var v=getActiveView();
  var sel=document.querySelector('input[name="sort-r"]:checked');
  if(sel){var parts=sel.value.split('-');v.sort.field=parts[0];v.sort.dir=parts[1];}
  closeSheet('sh-sort');renderList();
}
function applyCols(){closeSheet('sh-cols');renderList();}
function doSaveView(){
  var nm=document.getElementById('sv-name').value.trim();
  if(!nm)return;
  var v=getActiveView();
  var nv=JSON.parse(JSON.stringify(v));
  nv.id='uv-'+uuid();nv.name=nm;nv.isSystem=false;
  savedViews.push(nv);activeViewId=nv.id;
  document.getElementById('sv-name').value='';
  closeSheet('sh-saveview');renderViewsBar();renderList();
  showToast('View saved');
}
function viewCtx(id,e){
  e.preventDefault();
  if(!confirm('Delete this view?'))return;
  savedViews=savedViews.filter(function(v){return v.id!==id;});
  if(activeViewId===id)activeViewId='v-all';
  renderViewsBar();renderList();
}

// ===== MATERIAL DETAIL =====
function openMDetail(matId){
  _mdMatId=matId;
  var m=getMat(matId);
  document.getElementById('md-title').textContent=m.name;
  renderMdActionBar(m);
  setMTab(0);
  pushScreen('s-mdetail');
}
function renderMdActionBar(m){
  var ts=totalStock(m);
  var st=matStockStatus(m);
  var lowCount=m.variants.filter(function(v){return stockStatus(v)==='low';}).length;
  var outCount=m.variants.filter(function(v){return stockStatus(v)==='out';}).length;
  var alertMsg='';
  if(outCount>0)alertMsg='⚠ '+outCount+' variant'+(outCount>1?'s':'')+' out of stock';
  else if(lowCount>0)alertMsg='⚠ Low stock — '+lowCount+' variant'+(lowCount>1?'s':'');
  var html='<div class="stock-pill-row">';
  html+='<span class="stock-pill '+st+'">'+ts+' <span style="font-size:14px;font-weight:500;">'+esc(m.unit)+'</span></span>';
  if(alertMsg)html+='<span class="alert-pill">'+esc(alertMsg)+'</span>';
  html+='</div>';
  html+='<div class="action-row">';
  html+='<button class="action-btn" onclick="openBarcodeForMat()"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="2" height="14"/><rect x="7" y="5" width="1" height="14"/><rect x="10" y="5" width="2" height="14"/><rect x="15" y="5" width="1" height="14"/><rect x="19" y="5" width="2" height="14"/></svg>Barcode</button>';
  html+='<button class="action-btn" onclick="editCurrentMat()"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>Edit</button>';
  html+='<button class="action-btn" onclick="quickPurchaseOrder()"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>Purchase Order</button>';
  html+='<button class="action-btn" onclick="openSheet(\'sh-mat-actions\')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="5" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="12" cy="19" r="1"/></svg>More</button>';
  html+='</div>';
  document.getElementById('md-action-bar').innerHTML=html;
}
function editCurrentMat(){closeSheet('sh-mat-actions');openCreate(_mdMatId);}
function openBarcodeForMat(){showToast('Select a variant to generate barcode','info');}
function quickPurchaseOrder(){
  closeSheet('sh-mat-actions');
  initMatIn();
  var m=getMat(_mdMatId);
  if(m){document.getElementById('mi-vendor').value=m.vendors&&m.vendors[0]?m.vendors[0].name:'';}
  pushScreen('s-mat-in');
}
function addCurrentMatToCollection(){closeSheet('sh-mat-actions');showToast('Select a collection first','info');}
function addCurrentMatToListing(){closeSheet('sh-mat-actions');openListingDetail(null,_mdMatId);}
function duplicateCurrentMat(){
  closeSheet('sh-mat-actions');
  var m=getMat(_mdMatId);
  if(!m)return;
  var nm=JSON.parse(JSON.stringify(m));
  nm.id=nextId(materials);nm.name=m.name+' (Copy)';nm.sku=m.sku+'-COPY';
  materials.push(nm);renderList();
  showToast('Duplicated');goBack();
}
function deleteCurrentMat(){
  closeSheet('sh-mat-actions');
  if(!confirm('Delete this material?'))return;
  materials=materials.filter(function(m){return m.id!==_mdMatId;});
  renderList();showToast('Deleted');goBack();
}
function setMTab(n){
  document.querySelectorAll('#s-mdetail .tab').forEach(function(t,i){t.classList.toggle('on',i===n);});
  for(var i=0;i<5;i++){var el=document.getElementById('mt-'+i);if(el)el.style.display=i===n?'flex':'none';}
  var m=getMat(_mdMatId);if(!m)return;
  var el=document.getElementById('mt-'+n);if(!el)return;
  if(n===0)el.innerHTML=buildMDVariants(m);
  else if(n===1)el.innerHTML=buildMDSupply(m);
  else if(n===2)el.innerHTML=buildMDProduction(m,null);
  else if(n===3)el.innerHTML=buildMDListings(m);
  else if(n===4)el.innerHTML=buildMDCollections(m);
}
function buildMDVariants(m){
  var html='<div class="card">';
  html+='<div class="sect-hd"><h3>'+m.variants.length+' Variants</h3></div>';
  if(!m.variants.length)html+='<div class="empty-msg tx3">No variants yet</div>';
  m.variants.forEach(function(v,i){
    var st=stockStatus(v);
    html+='<div class="var-row"><div class="var-swatch" style="background:'+v.color+'"></div>';
    html+='<div class="var-info"><div class="var-name">'+esc(v.name)+'</div><div class="var-sku">'+esc(v.sku)+'</div></div>';
    html+='<span class="fw-6 fs-13">'+v.qty+'</span><span class="dot dot-'+st+'"></span>';
    html+='<div class="var-actions"><button class="btn-sm" onclick="openVDetail('+m.id+','+i+')">Edit →</button>';
    html+='<button class="btn-sm" onclick="openAddLabel('+m.id+','+i+')">🏷</button></div></div>';
  });
  html+='</div>';
  return html;
}
function buildMDSupply(m){
  var allRes=[];
  m.variants.forEach(function(v,vi){v.reservations.forEach(function(r){allRes.push(Object.assign({},r,{variantName:v.name}));});});
  var html='<div class="card"><div class="sect-hd"><h3>Reservations</h3><button class="btn-sm" onclick="openSheet(\'sh-reserve\')">+ Add</button></div>';
  if(!allRes.length)html+='<div class="tx3 text-center" style="padding:16px 0;">No reservations</div>';
  allRes.forEach(function(r){
    html+='<div class="loc-row"><div><div class="fw-6 fs-13">'+esc(r.customer)+'</div><div class="tx2 fs-12">'+esc(r.variantName)+' · '+esc(r.order)+'</div></div><span class="fw-6">'+r.qty+'</span></div>';
  });
  html+='</div>';
  html+='<div class="card"><div class="sect-hd"><h3>Production Queue</h3></div><p class="tx3 fs-13 text-center" style="padding:12px 0;">Connect to Production module to view queue.</p></div>';
  return html;
}
function buildMDProduction(m,filterVi){
  var html='<div class="card"><div class="sect-hd"><h3>B2B Lots</h3><span class="chip chip-f">0 running</span></div>';
  html+='<div class="tx3 text-center fs-13" style="padding:16px 0;">No B2B lots yet</div>';
  html+='<button class="btn-sm" style="width:100%;margin-top:8px;" onclick="showToast(\'Create lots in the Production module\',\'info\')">+ New B2B Lot</button>';
  html+='</div>';
  html+='<div class="card" style="margin-top:0;"><div class="sect-hd"><h3>B2C Orders</h3><span class="chip chip-p">0 running</span></div>';
  html+='<div class="tx3 text-center fs-13" style="padding:16px 0;">No B2C orders yet</div>';
  html+='<button class="btn-sm" style="width:100%;margin-top:8px;" onclick="showToast(\'Link B2C orders from the CRM module\',\'info\')">+ New B2C Order</button>';
  html+='</div>';
  html+='<p class="tx3 fs-12 text-center">Production lots are managed in the Production module.</p>';
  return html;
}
function buildMDListings(m){
  var mListings=channelListings.filter(function(l){return l.matId===m.id;});
  var html='<div class="card"><div class="sect-hd"><h3>Channel Listings</h3><button class="btn-sm" onclick="openListingDetail(null,'+m.id+')">+ Create</button></div>';
  if(!mListings.length)html+='<div class="tx3 text-center fs-13" style="padding:16px 0;">No listings yet</div>';
  mListings.forEach(function(l){
    var ch=channels.find(function(c){return c.id===l.channelId;})||{name:l.channelId,icon:'🌐'};
    html+='<div class="loc-row"><div><div class="fw-6 fs-13">'+ch.icon+' '+esc(ch.name)+'</div><div class="tx2 fs-12">'+esc(l.listingTitle||'Draft')+'</div></div>';
    html+='<div style="display:flex;align-items:center;gap:8px;"><span class="chip chip-'+l.status+'">'+l.status+'</span><button class="btn-sm" onclick="openListingDetail('+l.id+')">Edit</button></div></div>';
  });
  html+='</div>';
  return html;
}
function buildMDCollections(m){
  var mCols=collections.filter(function(c){return c.manualIds&&c.manualIds.indexOf(m.id)>=0;});
  var html='<div class="card"><div class="sect-hd"><h3>Collections</h3></div>';
  if(!mCols.length)html+='<div class="tx3 text-center fs-13" style="padding:16px 0;">Not in any collection yet</div>';
  mCols.forEach(function(c){
    var vis=c.visibility==='public'?'🌐':'🔒';
    html+='<div class="loc-row"><span class="fw-6 fs-13 flex-1">'+vis+' '+esc(c.name)+'</span><button class="btn-sm" onclick="openCDetail('+c.id+')">View</button></div>';
  });
  html+='</div>';
  return html;
}


// ===== VARIANT DETAIL =====
function openVDetail(matId,vi){
  _editMatId=matId;_editVi=vi;
  var m=getMat(matId);var v=m.variants[vi];
  document.getElementById('vd-title').textContent=v.name;
  setVTab(0);
  pushScreen('s-vdetail');
}
function setVTab(n){
  document.querySelectorAll('#s-vdetail .tab').forEach(function(t,i){t.classList.toggle('on',i===n);});
  for(var i=0;i<5;i++){var el=document.getElementById('vt-'+i);if(el)el.style.display=i===n?'flex':'none';}
  var m=getMat(_editMatId);var v=m&&m.variants[_editVi];if(!m||!v)return;
  var el=document.getElementById('vt-'+n);if(!el)return;
  if(n===0)el.innerHTML=buildVPricing(m,_editVi);
  else if(n===1)el.innerHTML=buildVInventory(m,_editVi);
  else if(n===2)el.innerHTML=buildVBOM(m,_editVi);
  else if(n===3)el.innerHTML=buildVCosting(m,_editVi);
  else if(n===4)el.innerHTML=buildVProduction(m,_editVi);
}
function saveVDetail(){
  var m=getMat(_editMatId);var v=m&&m.variants[_editVi];if(!m||!v)return;
  // Pricing tab
  var mrpEl=document.getElementById('vp-mrp');
  if(mrpEl){
    v.mrp=parseFloat(mrpEl.value)||0;
    v.offer=parseFloat((document.getElementById('vp-offer')||{}).value)||0;
    v.cost=parseFloat((document.getElementById('vp-cost')||{}).value)||0;
    v.barcode=(document.getElementById('vp-barcode')||{}).value||v.barcode;
  }
  showToast('Variant saved');
}
function buildVPricing(m,vi){
  var v=m.variants[vi];
  var disc=v.mrp>0?Math.round((1-v.offer/v.mrp)*100):0;
  var margin=v.offer>0?Math.round((v.offer-v.cost)/v.offer*100):0;
  return '<div class="card">'+
    '<div class="fld"><label>MRP</label><input type="number" id="vp-mrp" value="'+v.mrp+'" oninput="vCalcDisc()"></div>'+
    '<div class="fld"><label>Offer Price</label><input type="number" id="vp-offer" value="'+v.offer+'" oninput="vCalcDisc()"></div>'+
    '<div class="row-between mb-12"><span class="tx2 fs-13">Discount</span><span class="fw-6 fs-13" id="vp-disc">'+disc+'%</span></div>'+
    '<div class="fld"><label>Cost</label><input type="number" id="vp-cost" value="'+v.cost+'" oninput="vCalcMargin()"></div>'+
    '<div class="row-between"><span class="tx2 fs-13">Margin</span><span class="fw-6 fs-13" id="vp-margin">'+margin+'%</span></div>'+
    '</div>'+
    '<div class="card">'+
    '<div class="sect-hd"><h3>Barcode</h3></div>'+
    '<div class="fld"><label>Barcode value</label><input type="text" id="vp-barcode" value="'+esc(v.barcode)+'" placeholder="Enter or scan barcode"></div>'+
    '<div style="display:flex;gap:8px;">'+
    '<button class="btn-sm" onclick="setBarToSku()">Set to SKU</button>'+
    '<button class="btn-sm" onclick="openAddLabel('+m.id+','+vi+')">🏷 Print Label</button>'+
    '</div></div>';
}
function vCalcDisc(){
  var mrp=parseFloat(document.getElementById('vp-mrp').value)||0;
  var off=parseFloat(document.getElementById('vp-offer').value)||0;
  var d=mrp>0?Math.round((1-off/mrp)*100):0;
  var el=document.getElementById('vp-disc');if(el)el.textContent=d+'%';
  vCalcMargin();
}
function vCalcMargin(){
  var off=parseFloat(document.getElementById('vp-offer').value)||0;
  var cost=parseFloat(document.getElementById('vp-cost').value)||0;
  var m=off>0?Math.round((off-cost)/off*100):0;
  var el=document.getElementById('vp-margin');if(el)el.textContent=m+'%';
}
function setBarToSku(){
  var m=getMat(_editMatId);var v=m&&m.variants[_editVi];if(!v)return;
  var el=document.getElementById('vp-barcode');if(el)el.value=v.sku;
}
function buildVInventory(m,vi){
  var v=m.variants[vi];
  var reserved=v.reservations.reduce(function(s,r){return s+(r.qty||0);},0);
  var avail=Math.max(0,v.qty-reserved);
  var html='<div class="stat-row">'+
    '<div class="stat-tile"><div class="stat-val">'+v.qty+'</div><div class="stat-lbl">Total</div></div>'+
    '<div class="stat-tile"><div class="stat-val">'+avail+'</div><div class="stat-lbl">Available</div></div>'+
    '<div class="stat-tile"><div class="stat-val">'+reserved+'</div><div class="stat-lbl">Reserved</div></div>'+
    '</div>';
  html+='<div class="card"><div class="sect-hd"><h3>Location Breakdown</h3></div>';
  ['stores','jobbers','production','warehouse'].forEach(function(loc){
    var locs=v.inventory[loc];
    if(!locs||!locs.length)return;
    html+='<div class="loc-section"><div class="loc-section-hd"><span>'+loc.charAt(0).toUpperCase()+loc.slice(1)+'</span></div>';
    locs.forEach(function(l){
      html+='<div class="loc-row"><div style="display:flex;align-items:center;gap:6px;"><span class="dot" style="background:'+l.color+'"></span><span class="fs-13">'+esc(l.loc)+'</span></div><span class="fw-6 fs-13">'+l.qty+'</span></div>';
    });
    html+='</div>';
  });
  html+='</div>';
  html+='<div style="display:flex;gap:8px;">'+
    '<button class="btn-s" style="flex:1;" onclick="openMoveSheet()">Record Movement</button>'+
    '<button class="btn-s" style="flex:1;" onclick="openStockCount()">Stock Count</button>'+
    '</div>';
  if(v.movements&&v.movements.length){
    html+='<div class="card"><div class="sect-hd"><h3>Movements</h3></div>';
    v.movements.slice(-10).reverse().forEach(function(mv){
      var isIn=mv.type==='Stock in';
      html+='<div class="mov-row"><div><div class="mov-type">'+esc(mv.type)+(mv.subtype?' · '+esc(mv.subtype):'')+'</div><div class="mov-meta">'+esc(mv.date)+(mv.ref?' · '+esc(mv.ref):'')+'</div></div>';
      html+='<span class="mov-qty '+(isIn?'in':'out')+'">'+(isIn?'+':'')+mv.qty+'</span></div>';
    });
    html+='</div>';
  }
  if(v.reservations&&v.reservations.length){
    html+='<div class="card"><div class="sect-hd"><h3>Reservations</h3><button class="btn-sm" onclick="openSheet(\'sh-reserve\')">+ Add</button></div>';
    v.reservations.forEach(function(r){
      html+='<div class="loc-row"><div><div class="fw-6 fs-13">'+esc(r.customer)+'</div><div class="tx2 fs-12">'+esc(r.order)+'</div></div><span class="fw-6">'+r.qty+'</span></div>';
    });
    html+='</div>';
  }
  return html;
}
function openMoveSheet(){
  document.getElementById('mv-date').value=todayStr();
  document.getElementById('mv-qty').value='';
  openSheet('sh-move');
}
function openStockCount(){
  var m=getMat(_editMatId);var v=m&&m.variants[_editVi];if(!v)return;
  document.getElementById('sc-sysqty').textContent=v.qty;
  document.getElementById('sc-qty').value='';
  document.getElementById('sc-preview').style.display='none';
  document.getElementById('sc-desc').textContent='Physical count for: '+v.name;
  openSheet('sh-stockcount');
}
function updateScPreview(){
  var m=getMat(_editMatId);var v=m&&m.variants[_editVi];if(!v)return;
  var phys=parseInt(document.getElementById('sc-qty').value)||0;
  var diff=phys-v.qty;
  var prev=document.getElementById('sc-preview');
  prev.style.display='block';
  prev.style.background=diff<0?'var(--rl)':diff>0?'var(--gl)':'var(--sf2)';
  prev.style.color=diff<0?'var(--rt)':diff>0?'var(--gt)':'var(--tx2)';
  prev.textContent='System: '+v.qty+' → Physical: '+phys+'. Adjustment: '+(diff>=0?'+':'')+diff;
}
function confirmStockCount(){
  var m=getMat(_editMatId);var v=m&&m.variants[_editVi];if(!v)return;
  var phys=parseInt(document.getElementById('sc-qty').value);
  if(isNaN(phys)||phys<0){showToast('Enter a valid quantity','error');return;}
  var diff=phys-v.qty;
  v.movements=v.movements||[];
  v.movements.push({date:todayStr(),type:'Adjustment',subtype:'Stock count',qty:diff,rate:0,ref:'',note:'System: '+v.qty+', Physical: '+phys});
  v.qty=phys;
  closeSheet('sh-stockcount');
  openMDetail(_mdMatId||_editMatId);
  showToast('Stock count saved');
}
function saveMovement(){
  var m=getMat(_editMatId);var v=m&&m.variants[_editVi];if(!m)return;
  var type=document.getElementById('mv-type').value;
  var qty=parseFloat(document.getElementById('mv-qty').value)||0;
  if(!qty){showToast('Enter quantity','error');return;}
  var mv={date:document.getElementById('mv-date').value||todayStr(),type:type,subtype:'',qty:qty,rate:parseFloat(document.getElementById('mv-rate').value)||0,ref:document.getElementById('mv-ref').value,note:document.getElementById('mv-note').value};
  if(v){
    v.movements=v.movements||[];v.movements.push(mv);
    if(type==='Stock in')v.qty+=qty;
    else if(type==='Stock out'||type==='Transfer')v.qty=Math.max(0,v.qty-qty);
    else if(type==='Adjustment')v.qty=Math.max(0,v.qty+qty);
  }
  closeSheet('sh-move');setVTab(1);showToast('Movement recorded');
}
function saveReservation(){
  var m=getMat(_editMatId||_mdMatId);var vi=_editVi!==null?_editVi:0;if(!m)return;
  var v=m.variants[vi];if(!v)return;
  v.reservations=v.reservations||[];
  v.reservations.push({order:document.getElementById('res-order').value,customer:document.getElementById('res-customer').value,qty:parseInt(document.getElementById('res-qty').value)||0,status:'active',date:document.getElementById('res-date').value||todayStr()});
  closeSheet('sh-reserve');
  if(_editVi!==null)setVTab(1);else setMTab(1);
  showToast('Reservation added');
}
function resolveBOM(m,vi){
  var v=m.variants[vi];
  var base=m.bom?m.bom.slice():[]; // product-level
  var overrides=v&&v.bomOverrides?v.bomOverrides:[];
  overrides.forEach(function(o){
    var idx=base.findIndex(function(b){return b.materialId===o.materialId;});
    if(idx>=0)base[idx]=o;else base.push(o);
  });
  return base;
}
function buildVBOM(m,vi){
  var v=m.variants[vi];
  var resolved=resolveBOM(m,vi);
  var hasOverrides=v.bomOverrides&&v.bomOverrides.length>0;
  var html='';
  // Badge
  html+='<div class="card"><div class="sect-hd"><h3>BOM for '+esc(v.name)+'</h3>';
  if(hasOverrides)html+='<span class="chip" style="background:var(--al);color:var(--at);">Has overrides</span>';
  else html+='<span class="chip" style="background:var(--sf2);color:var(--tx3);">Inherited from product</span>';
  html+='</div>';
  if(!resolved.length)html+='<div class="tx3 text-center fs-13" style="padding:12px 0;">No BOM lines</div>';
  resolved.forEach(function(bl){
    var isOv=bl.isVariantOverride;
    html+='<div class="bom-row"><div class="flex-1"><div class="fw-6 fs-13">'+esc(bl.materialName)+(bl.variantIdx!==null?' (variant '+bl.variantIdx+')':'')+'</div>';
    html+='<div class="tx2 fs-12">'+esc(bl.note||'')+'</div>';
    if(!isOv)html+='<span class="inherited-tag">inherited</span>';
    html+='</div><div style="text-align:right;"><div class="fw-6 fs-13">'+bl.qty+' '+esc(bl.unit)+'</div>';
    html+='<div style="display:flex;gap:6px;margin-top:4px;"><button class="btn-ghost" onclick="openEditBOMLine(\''+bl.id+'\','+vi+')">edit</button><button class="btn-ghost" style="color:var(--r);" onclick="deleteBOMLine(\''+bl.id+'\','+vi+')">del</button></div>';
    html+='</div></div>';
  });
  html+='<div style="display:flex;gap:8px;margin-top:8px;">'+
    '<button class="btn-sm" onclick="openAddBOMLine('+vi+',false)">+ Add line</button>';
  if(!hasOverrides&&m.bom&&m.bom.length)html+='<button class="btn-sm" onclick="copyProductBOM('+vi+')">Copy from product</button>';
  html+='</div></div>';
  // TechPack
  html+='<div class="card"><div class="sect-hd"><h3>TechPack Document</h3></div>'+
    '<div class="fld"><label>Document URL</label><input type="text" id="vtp-url" value="'+esc(m.techpackUrl)+'" placeholder="https://..."></div>'+
    '<div class="fld"><label>Upload file</label><input type="file" accept=".pdf,.jpg,.png"></div>'+
    '</div>';
  return html;
}
function openAddBOMLine(vi,isProduct){
  _blTarget={matId:_editMatId,vi:vi,isProductLevel:isProduct};
  document.getElementById('bl-title').textContent='Add BOM Line';
  document.getElementById('bl-qty').value='';
  document.getElementById('bl-note').value='';
  // Populate material selector
  var sel=document.getElementById('bl-mat');
  sel.innerHTML='<option value="">Select material…</option>';
  materials.filter(function(m){return m.type==='raw';}).forEach(function(m){
    sel.innerHTML+='<option value="'+m.id+'">'+esc(m.name)+'</option>';
  });
  updateBlVariants();
  openSheet('sh-bomline');
}
function openEditBOMLine(blId,vi){
  openAddBOMLine(vi,false);
  document.getElementById('bl-title').textContent='Edit BOM Line';
}
function updateBlVariants(){
  var matId=parseInt(document.getElementById('bl-mat').value);
  var sel=document.getElementById('bl-var');
  sel.innerHTML='<option value="">Any variant</option>';
  if(matId){var m=getMat(matId);if(m)m.variants.forEach(function(v,i){sel.innerHTML+='<option value="'+i+'">'+esc(v.name)+'</option>';});}
}
function saveBOMLine(){
  var t=_blTarget;if(!t)return;
  var m=getMat(t.matId);if(!m)return;
  var matId=parseInt(document.getElementById('bl-mat').value);
  if(!matId){showToast('Select a material','error');return;}
  var rawMat=getMat(matId);
  var qty=parseFloat(document.getElementById('bl-qty').value)||0;
  var unit=document.getElementById('bl-unit').value;
  var vi=document.getElementById('bl-var').value;
  var note=document.getElementById('bl-note').value;
  var line={id:uuid(),materialId:matId,materialName:rawMat?rawMat.name:'',variantIdx:vi!==''?parseInt(vi):null,qty:qty,unit:unit,note:note,isVariantOverride:!t.isProductLevel};
  if(t.isProductLevel){m.bom=m.bom||[];m.bom.push(line);}
  else{var v=m.variants[t.vi];v.bomOverrides=v.bomOverrides||[];line.isVariantOverride=true;v.bomOverrides.push(line);}
  closeSheet('sh-bomline');setVTab(2);showToast('BOM line added');
}
function deleteBOMLine(blId,vi){
  var m=getMat(_editMatId);if(!m)return;
  m.bom=m.bom.filter(function(b){return b.id!==blId;});
  var v=m.variants[vi];if(v)v.bomOverrides=v.bomOverrides.filter(function(b){return b.id!==blId;});
  setVTab(2);showToast('Line removed');
}
function copyProductBOM(vi){
  var m=getMat(_editMatId);if(!m)return;
  var v=m.variants[vi];if(!v)return;
  v.bomOverrides=(m.bom||[]).map(function(b){return Object.assign({},b,{id:uuid(),isVariantOverride:true});});
  setVTab(2);showToast('Copied from product BOM');
}
function buildVCosting(m,vi){
  var v=m.variants[vi];
  var lines=v.costLines||[];
  var total=lines.reduce(function(s,l){return s+(l.amount||0);},0);
  var margin=v.offer>0?Math.round((v.offer-total)/v.offer*100):0;
  var html='<div class="card"><div class="sect-hd"><h3>Cost Breakdown</h3><button class="btn-sm" onclick="addCostLine('+vi+')">+ Add</button></div>';
  lines.forEach(function(l,i){
    html+='<div class="cost-row"><input type="text" value="'+esc(l.desc)+'" style="flex:1;margin-right:8px;" onchange="updateCostLine('+vi+','+i+',\'desc\',this.value)"><input type="number" value="'+l.amount+'" style="width:80px;" onchange="updateCostLine('+vi+','+i+',\'amount\',this.value)"><button class="btn-ghost" style="color:var(--r);" onclick="removeCostLine('+vi+','+i+')">×</button></div>';
  });
  html+='<div class="sum-row total"><span>Total Cost</span><span>'+fmtMoney(total)+'</span></div>';
  html+='</div>';
  html+='<div class="card"><div class="sect-hd"><h3>Margin Analysis</h3></div>'+
    '<div class="sum-row"><span class="tx2">Offer Price</span><span>'+fmtMoney(v.offer)+'</span></div>'+
    '<div class="sum-row"><span class="tx2">Total Cost</span><span>'+fmtMoney(total)+'</span></div>'+
    '<div class="sum-row total"><span>Margin</span><span style="color:var(--g);">'+margin+'%</span></div>'+
    '</div>';
  return html;
}
function addCostLine(vi){var m=getMat(_editMatId);var v=m&&m.variants[vi];if(!v)return;v.costLines=v.costLines||[];v.costLines.push({desc:'',amount:0});setVTab(3);}
function updateCostLine(vi,i,field,val){var m=getMat(_editMatId);var v=m&&m.variants[vi];if(!v||!v.costLines[i])return;v.costLines[i][field]=field==='amount'?parseFloat(val)||0:val;}
function removeCostLine(vi,i){var m=getMat(_editMatId);var v=m&&m.variants[vi];if(!v)return;v.costLines.splice(i,1);setVTab(3);}
function buildVProduction(m,vi){return buildMDProduction(m,vi);}


// ===== CREATE/EDIT MATERIAL =====
function openCreate(matId){
  _editMatId=matId;
  var m=matId?getMat(matId):null;
  document.getElementById('create-title').textContent=m?m.name:'New Material';
  setCTab(0);
  pushScreen('s-create');
}
function setCTab(n){
  document.querySelectorAll('#s-create .tab').forEach(function(t,i){t.classList.toggle('on',i===n);});
  for(var i=0;i<3;i++){var el=document.getElementById('ct-'+i);if(el)el.style.display=i===n?'flex':'none';}
  var m=_editMatId?getMat(_editMatId):{id:null,name:'',type:'finished',sku:'',designNo:'',unit:'pcs',vendors:[],imgs:[],desc:'',notes:'',techpackUrl:'',techpackFile:'',externalLinks:[],bom:[],cats:[],collections:[],variants:[]};
  var el=document.getElementById('ct-'+n);if(!el)return;
  if(n===0)el.innerHTML=buildInfoHTML(m);
  else if(n===1)el.innerHTML=buildVariantsHTML(m);
  else if(n===2)el.innerHTML=buildMovementHTML(m);
}
function buildInfoHTML(m){
  var html='<div class="card">'+
    '<div class="fld"><label>Name *</label><input type="text" id="ci-name" value="'+esc(m.name)+'" placeholder="Material name" oninput="autoSku()"></div>'+
    '<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">'+
    '<div class="fld"><label>SKU</label><input type="text" id="ci-sku" value="'+esc(m.sku)+'" placeholder="Auto-generated"></div>'+
    '<div class="fld"><label>Design No.</label><input type="text" id="ci-design" value="'+esc(m.designNo)+'" placeholder="D-001"></div>'+
    '</div>'+
    '<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">'+
    '<div class="fld"><label>Type</label><select id="ci-type" onchange="setCTab(0)"><option value="finished"'+(m.type==='finished'?' selected':'')+'>Finished</option><option value="raw"'+(m.type==='raw'?' selected':'')+'>Raw Material</option><option value="production"'+(m.type==='production'?' selected':'')+'>Production</option></select></div>'+
    '<div class="fld"><label>Unit</label><select id="ci-unit"><option'+(m.unit==='pcs'?' selected':'')+'>pcs</option><option'+(m.unit==='metres'?' selected':'')+'>metres</option><option'+(m.unit==='kg'?' selected':'')+'>kg</option><option'+(m.unit==='sets'?' selected':'')+'>sets</option><option'+(m.unit==='litres'?' selected':'')+'>litres</option></select></div>'+
    '</div>'+
    '<div class="fld"><label>Description</label><textarea id="ci-desc" rows="2" placeholder="Product description">'+esc(m.desc)+'</textarea></div>'+
    '<div class="fld"><label>Notes</label><textarea id="ci-notes" rows="2" placeholder="Internal notes">'+esc(m.notes)+'</textarea></div>'+
    '</div>';
  // Vendor
  html+='<div class="card"><div class="sect-hd"><h3>Vendors</h3><button class="btn-sm" onclick="addVendorRow()">+ Add</button></div>';
  html+='<div id="ci-vendors">';
  (m.vendors||[]).forEach(function(v,i){
    html+='<div class="var-row"><div class="var-info"><div class="var-name">'+esc(v.name)+'</div><div class="var-sku">'+esc(v.type)+(v.lead?' · '+esc(v.lead):'')+'</div></div><button class="btn-ghost" style="color:var(--r);" onclick="removeVendorRow('+i+')">×</button></div>';
  });
  html+='</div></div>';
  // Pricing
  var p0=m.variants&&m.variants[0]||{mrp:0,offer:0,cost:0};
  html+='<div class="card"><div class="sect-hd"><h3>Global Pricing</h3><button class="btn-ghost" onclick="copyGlobalPricing()">Copy to all variants</button></div>'+
    '<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;">'+
    '<div class="fld"><label>MRP</label><input type="number" id="ci-mrp" value="'+p0.mrp+'" placeholder="0"></div>'+
    '<div class="fld"><label>Offer</label><input type="number" id="ci-offer" value="'+p0.offer+'" placeholder="0"></div>'+
    '<div class="fld"><label>Cost</label><input type="number" id="ci-cost" value="'+p0.cost+'" placeholder="0"></div>'+
    '</div></div>';
  // BOM (only for finished/production)
  var tp=(document.getElementById('ci-type')||{}).value||m.type;
  if(tp!=='raw'){
    html+='<div class="card"><div class="sect-hd"><h3>Bill of Materials</h3><button class="btn-sm" onclick="openAddBOMLine(-1,true)">+ Add line</button></div>';
    html+='<div id="ci-bom">';
    (m.bom||[]).forEach(function(bl){
      html+='<div class="bom-row"><div class="flex-1"><div class="fw-6 fs-13">'+esc(bl.materialName)+'</div><div class="tx2 fs-12">'+bl.qty+' '+esc(bl.unit)+'</div></div><button class="btn-ghost" style="color:var(--r);" onclick="deleteProdBOMLine(\''+bl.id+'\')">×</button></div>';
    });
    if(!m.bom||!m.bom.length)html+='<div class="tx3 fs-13 text-center" style="padding:8px 0;">No BOM lines</div>';
    html+='</div></div>';
  }
  // Variant categories
  html+='<div class="card"><div class="sect-hd"><h3>Variant Categories</h3><button class="btn-sm" onclick="addCategory()">+ Add</button></div>';
  html+='<div id="ci-cats">';
  (m.cats||[]).forEach(function(cat,ci){
    html+='<div class="mb-8"><div class="row-between mb-4"><span class="fw-6 fs-13">'+esc(cat.name)+'</span><button class="btn-ghost" style="color:var(--r);" onclick="removeCategory('+ci+')">×</button></div>';
    html+='<div style="display:flex;flex-wrap:wrap;gap:6px;">';
    cat.values.forEach(function(val){html+='<span class="chip chip-f">'+esc(val)+'</span>';});
    html+='</div></div>';
  });
  html+='</div>';
  html+='<div style="margin-top:8px;display:flex;gap:8px;">'+
    '<select id="ci-preset" style="flex:1;"><option value="">Load preset…</option>';
  optionSets.forEach(function(os){html+='<option value="'+os.id+'">'+esc(os.name)+'</option>';});
  html+='</select><button class="btn-sm" onclick="loadPreset()">Load</button></div>';
  html+='<button class="btn-sm" style="width:100%;margin-top:8px;" onclick="generateVariants()">⚡ Generate combinations</button>';
  html+='</div>';
  return html;
}
function autoSku(){
  var nm=(document.getElementById('ci-name')||{}).value||'';
  var sku=nm.trim().split(' ').map(function(w){return w.charAt(0).toUpperCase();}).join('')+'-001';
  var el=document.getElementById('ci-sku');if(el&&!el._touched)el.value=sku;
}
function copyGlobalPricing(){
  var mrp=parseFloat(document.getElementById('ci-mrp').value)||0;
  var offer=parseFloat(document.getElementById('ci-offer').value)||0;
  var cost=parseFloat(document.getElementById('ci-cost').value)||0;
  var m=_editMatId?getMat(_editMatId):null;if(!m)return;
  m.variants.forEach(function(v){v.mrp=mrp;v.offer=offer;v.cost=cost;});
  showToast('Pricing copied to all variants');
}
function addVendorRow(){showToast('Vendor editor coming soon','info');}
function removeVendorRow(i){var m=_editMatId?getMat(_editMatId):null;if(m&&m.vendors)m.vendors.splice(i,1);setCTab(0);}
function deleteProdBOMLine(id){var m=_editMatId?getMat(_editMatId):null;if(m)m.bom=m.bom.filter(function(b){return b.id!==id;});setCTab(0);}
function addCategory(){
  var nm=prompt('Category name (e.g. Size):');if(!nm)return;
  var vals=prompt('Values, comma-separated (e.g. S,M,L):');if(!vals)return;
  var m=_editMatId?getMat(_editMatId):null;
  if(!m){window._pendingCats=window._pendingCats||[];window._pendingCats.push({name:nm,values:vals.split(',').map(function(v){return v.trim();})});setCTab(0);return;}
  m.cats=m.cats||[];m.cats.push({name:nm,values:vals.split(',').map(function(v){return v.trim();})});
  setCTab(0);
}
function removeCategory(i){var m=_editMatId?getMat(_editMatId):null;if(m&&m.cats)m.cats.splice(i,1);setCTab(0);}
function loadPreset(){
  var sel=document.getElementById('ci-preset');if(!sel||!sel.value)return;
  var os=optionSets.find(function(o){return o.id===sel.value;});if(!os)return;
  var m=_editMatId?getMat(_editMatId):null;
  if(!m){showToast('Save material first','info');return;}
  m.cats=m.cats||[];
  if(m.cats.find(function(c){return c.name===os.name;})){showToast(os.name+' already added','info');return;}
  m.cats.push({name:os.name,values:os.values.slice()});
  setCTab(0);showToast(os.name+' added');
}
function generateVariants(){
  var m=_editMatId?getMat(_editMatId):null;if(!m){showToast('Save material first','info');return;}
  if(!m.cats||!m.cats.length){showToast('Add categories first','info');return;}
  var combos=[['']];
  m.cats.forEach(function(cat){
    var next=[];combos.forEach(function(combo){cat.values.forEach(function(val){next.push(combo.concat([val]));});});combos=next;
  });
  m.variants=combos.map(function(combo){
    var name=combo.slice(1).join(' / ');
    return {name:name,sku:m.sku+'-'+combo.slice(1).join('-').toUpperCase().replace(/\s/g,''),mrp:0,offer:0,cost:0,qty:0,barcode:'',minqty:0,color:'#4A3BB5',tags:[],images:[],notes:'',costLines:[],bomOverrides:[],reservations:[],movements:[],inventory:{stores:[],jobbers:[],production:[],warehouse:[]}};
  });
  showToast(m.variants.length+' variants generated');setCTab(1);
}
function buildVariantsHTML(m){
  if(!m.variants||!m.variants.length)return '<div class="empty"><div class="empty-icon">📦</div><div class="empty-msg">No variants yet. Add categories in Info tab and generate.</div></div>';
  var html='<div class="card"><div class="sect-hd"><h3>'+m.variants.length+' Variants</h3></div>';
  m.variants.forEach(function(v,i){
    var st=stockStatus(v);
    html+='<div class="var-row"><div class="var-swatch" style="background:'+v.color+'"></div>';
    html+='<div class="var-info"><div class="var-name">'+esc(v.name)+'</div><div class="var-sku">'+esc(v.sku)+'</div></div>';
    html+='<span class="fw-6 fs-13">'+v.qty+'</span><span class="dot dot-'+st+'"></span>';
    html+='<button class="btn-sm" onclick="openVDetail('+m.id+','+i+')">Edit →</button>';
    html+='</div>';
  });
  html+='</div>';
  return html;
}
function buildMovementHTML(m){
  var all=[];
  m.variants.forEach(function(v,vi){(v.movements||[]).forEach(function(mv){all.push(Object.assign({},mv,{variantName:v.name}));});});
  all.sort(function(a,b){return b.date.localeCompare(a.date);});
  var html='<div class="card"><div class="sect-hd"><h3>All Movements</h3><button class="btn-sm" onclick="openMoveSheet()">Record</button></div>';
  if(!all.length)html+='<div class="tx3 text-center" style="padding:16px;">No movements recorded</div>';
  all.forEach(function(mv){
    var isIn=mv.type==='Stock in';
    html+='<div class="mov-row"><div><div class="mov-type">'+esc(mv.variantName)+' · '+esc(mv.type)+'</div><div class="mov-meta">'+esc(mv.date)+(mv.ref?' · '+esc(mv.ref):'')+'</div></div>';
    html+='<span class="mov-qty '+(isIn?'in':'out')+'">'+(isIn?'+':'')+mv.qty+'</span></div>';
  });
  html+='</div>';
  return html;
}
function saveCreate(){
  var name=(document.getElementById('ci-name')||{}).value||'';
  if(!name.trim()){showToast('Enter material name','error');return;}
  var m=_editMatId?getMat(_editMatId):null;
  var isNew=!m;
  if(isNew){m={id:nextId(materials),name:'',type:'finished',sku:'',designNo:'',unit:'pcs',vendors:[],imgs:[],desc:'',notes:'',techpackUrl:'',techpackFile:'',externalLinks:[],bom:[],cats:[],collections:[],variants:[]};materials.push(m);_editMatId=m.id;}
  m.name=name;
  m.sku=(document.getElementById('ci-sku')||{}).value||m.sku;
  m.designNo=(document.getElementById('ci-design')||{}).value||'';
  m.type=(document.getElementById('ci-type')||{}).value||m.type;
  m.unit=(document.getElementById('ci-unit')||{}).value||m.unit;
  m.desc=(document.getElementById('ci-desc')||{}).value||'';
  m.notes=(document.getElementById('ci-notes')||{}).value||'';
  renderList();
  showToast(isNew?'Material created':'Material saved');
  goBack();
}

// ===== MATERIAL IN / OUT =====
function initMatIn(){
  document.getElementById('mi-entryno').value='MI-'+Date.now().toString().slice(-6);
  document.getElementById('mi-date').value=todayStr();
  document.getElementById('mi-vendor').value='';
  document.getElementById('mi-invoice').value='';
  document.getElementById('mi-notes').value='';
  window._miItems=[];
  renderMiItems();
}
function renderMiItems(){
  var el=document.getElementById('mi-items');if(!el)return;
  var html='';
  (window._miItems||[]).forEach(function(it,i){
    html+='<div class="mi-item"><div class="mi-item-hd"><span class="mi-item-name">'+(it.matName||'Tap to select material')+'</span><button class="btn-ghost" style="color:var(--r);" onclick="removeMiItem('+i+')">×</button></div>';
    html+='<button class="btn-sm mb-8" onclick="openMatItemPicker(\'in\','+i+')">'+esc(it.varName||'Select variant →')+'</button>';
    html+='<div class="mi-item-grid"><div class="fld"><label>Qty</label><input type="number" value="'+it.qty+'" onchange="updateMiItem('+i+',\'qty\',this.value)" min="0"></div>';
    html+='<div class="fld"><label>Rate ₹</label><input type="number" value="'+it.rate+'" onchange="updateMiItem('+i+',\'rate\',this.value)" min="0"></div></div>';
    html+='</div>';
  });
  if(el)el.innerHTML=html;
  calcMiTotal();
}
function addMatInItem(){window._miItems=window._miItems||[];window._miItems.push({matId:null,varIdx:null,matName:'',varName:'',qty:1,unit:'pcs',rate:0});renderMiItems();}
function removeMiItem(i){window._miItems.splice(i,1);renderMiItems();}
function updateMiItem(i,field,val){if(window._miItems[i])window._miItems[i][field]=field==='qty'||field==='rate'?parseFloat(val)||0:val;calcMiTotal();}
function calcMiTotal(){
  var sub=(window._miItems||[]).reduce(function(s,it){return s+(it.qty||0)*(it.rate||0);},0);
  var gstOn=document.getElementById('mi-gst')&&document.getElementById('mi-gst').checked;
  var gstPct=parseFloat((document.getElementById('mi-gstpct')||{}).value)||0;
  var total=gstOn?sub*(1+gstPct/100):sub;
  var subEl=document.getElementById('mi-subtotal');if(subEl)subEl.textContent=fmtMoney(sub);
  var totEl=document.getElementById('mi-total');if(totEl)totEl.textContent=fmtMoney(total);
}
function saveMatIn(){
  var items=window._miItems||[];
  if(!items.length){showToast('Add at least one item','error');return;}
  var entry={id:nextId(matInEntries),entryNo:document.getElementById('mi-entryno').value,date:document.getElementById('mi-date').value,purchaseType:document.getElementById('mi-type').value,vendor:document.getElementById('mi-vendor').value,invoiceRef:document.getElementById('mi-invoice').value,notes:document.getElementById('mi-notes').value,items:items.slice(),gstApplicable:document.getElementById('mi-gst').checked,gstPct:parseFloat(document.getElementById('mi-gstpct').value)||0,grandTotal:0};
  // Update stock
  items.forEach(function(it){
    if(it.matId!==null&&it.varIdx!==null){
      var m=getMat(it.matId);var v=m&&m.variants[it.varIdx];
      if(v){v.qty+=(it.qty||0);v.movements=v.movements||[];v.movements.push({date:entry.date,type:'Stock in',subtype:'Purchase',qty:it.qty,rate:it.rate,ref:entry.entryNo,note:''});}
    }
  });
  matInEntries.push(entry);renderList();showToast('Entry saved');goBack();
}
function initMatOut(){
  document.getElementById('mo-entryno').value='MO-'+Date.now().toString().slice(-6);
  document.getElementById('mo-date').value=todayStr();
  document.getElementById('mo-notes').value='';
  window._moItems=[];
  renderMoRecipient();renderMoItems();
}
function renderMoRecipient(){
  var type=(document.getElementById('mo-type')||{}).value||'jobber';
  var html='';
  if(type==='jobber')html='<div class="fld"><label>Jobber Name</label><input type="text" id="mo-rec" placeholder="Jobber name"></div><div class="fld"><label>Job Ref</label><input type="text" id="mo-ref" placeholder="Job reference"></div>';
  else if(type==='customer')html='<div class="fld"><label>Customer Name</label><input type="text" id="mo-rec" placeholder="Customer name"></div><div class="fld"><label>Order Ref</label><input type="text" id="mo-ref" placeholder="Order number"></div>';
  else if(type==='sales')html='<div class="fld"><label>Customer Name</label><input type="text" id="mo-rec" placeholder="Customer name"></div><div class="fld"><label>Invoice Ref</label><input type="text" id="mo-ref" placeholder="Invoice number"></div>';
  else html='<div class="fld"><label>Recipient</label><input type="text" id="mo-rec" placeholder="Recipient"></div><div class="fld"><label>Reason</label><input type="text" id="mo-ref" placeholder="Reason"></div>';
  document.getElementById('mo-recipient-fields').innerHTML=html;
}
function renderMoItems(){
  var el=document.getElementById('mo-items');if(!el)return;
  var html='';
  (window._moItems||[]).forEach(function(it,i){
    html+='<div class="mi-item"><div class="mi-item-hd"><span class="mi-item-name">'+(it.matName||'Tap to select')+'</span><button class="btn-ghost" style="color:var(--r);" onclick="removeMoItem('+i+')">×</button></div>';
    html+='<button class="btn-sm mb-8" onclick="openMatItemPicker(\'out\','+i+')">'+esc(it.varName||'Select variant →')+'</button>';
    html+='<div class="mi-item-grid"><div class="fld"><label>Qty</label><input type="number" value="'+it.qty+'" onchange="updateMoItem('+i+',\'qty\',this.value)" min="0"></div>';
    html+='<div class="fld"><label>Rate ₹ (opt.)</label><input type="number" value="'+it.rate+'" onchange="updateMoItem('+i+',\'rate\',this.value)" min="0"></div></div></div>';
  });
  el.innerHTML=html;calcMoTotal();
}
function addMatOutItem(){window._moItems=window._moItems||[];window._moItems.push({matId:null,varIdx:null,matName:'',varName:'',qty:1,unit:'pcs',rate:0});renderMoItems();}
function removeMoItem(i){window._moItems.splice(i,1);renderMoItems();}
function updateMoItem(i,field,val){if(window._moItems[i])window._moItems[i][field]=field==='qty'||field==='rate'?parseFloat(val)||0:val;calcMoTotal();}
function calcMoTotal(){var total=(window._moItems||[]).reduce(function(s,it){return s+(it.qty||0)*(it.rate||0);},0);var el=document.getElementById('mo-total');if(el)el.textContent=fmtMoney(total);}
function saveMatOut(){
  var items=window._moItems||[];
  if(!items.length){showToast('Add at least one item','error');return;}
  var rec=(document.getElementById('mo-rec')||{}).value||'';
  var ref=(document.getElementById('mo-ref')||{}).value||'';
  var entry={id:nextId(matOutEntries),entryNo:document.getElementById('mo-entryno').value,date:document.getElementById('mo-date').value,outType:document.getElementById('mo-type').value,recipient:rec,jobRef:ref,orderRef:ref,notes:document.getElementById('mo-notes').value,items:items.slice(),total:0};
  items.forEach(function(it){
    if(it.matId!==null&&it.varIdx!==null){
      var m=getMat(it.matId);var v=m&&m.variants[it.varIdx];
      if(v){v.qty=Math.max(0,v.qty-(it.qty||0));v.movements=v.movements||[];v.movements.push({date:entry.date,type:'Stock out',subtype:entry.outType,qty:it.qty,rate:it.rate,ref:entry.entryNo,note:''});}
    }
  });
  matOutEntries.push(entry);renderList();showToast('Entry saved');goBack();
}
// Material item picker
function openMatItemPicker(target,idx){
  _miItemTarget=target;_miItemIdx=idx;
  document.getElementById('mi-search').value='';
  renderMatItemPicker();
  openSheet('sh-matitem');
}
function renderMatItemPicker(){
  var q=(document.getElementById('mi-search')||{}).value||'';
  var el=document.getElementById('mi-picker-list');if(!el)return;
  var html='';
  materials.filter(function(m){return !q||m.name.toLowerCase().indexOf(q.toLowerCase())>=0;}).forEach(function(m){
    html+='<div style="padding:8px 0;"><div class="fw-6 fs-13 mb-4">'+esc(m.name)+'</div>';
    m.variants.forEach(function(v,vi){
      html+='<div class="var-row" style="padding:6px 8px;cursor:pointer;" onclick="selectMatItem('+m.id+','+vi+')"><div class="var-swatch" style="background:'+v.color+'"></div><div class="var-info"><div class="var-name">'+esc(v.name)+'</div><div class="var-sku">'+esc(v.sku)+'</div></div><span class="fw-6">'+v.qty+'</span></div>';
    });
    html+='</div>';
  });
  el.innerHTML=html||'<div class="tx3 text-center" style="padding:24px;">No materials found</div>';
}
function selectMatItem(matId,varIdx){
  var m=getMat(matId);var v=m&&m.variants[varIdx];if(!m||!v)return;
  var items=_miItemTarget==='in'?window._miItems:window._moItems;
  if(items&&items[_miItemIdx]){items[_miItemIdx].matId=matId;items[_miItemIdx].varIdx=varIdx;items[_miItemIdx].matName=m.name;items[_miItemIdx].varName=v.name;items[_miItemIdx].unit=m.unit;}
  closeSheet('sh-matitem');
  if(_miItemTarget==='in')renderMiItems();else renderMoItems();
}


// ===== LABELS =====
function renderLabels(){
  setLTab(0);
  var qtab=document.getElementById('l-tab-queue');
  if(qtab)qtab.textContent='Queue'+(labelQueue.length?'  ('+labelQueue.length+')':'');
}
function setLTab(n){
  document.querySelectorAll('#s-labels .tab').forEach(function(t,i){t.classList.toggle('on',i===n);});
  for(var i=0;i<2;i++){var el=document.getElementById('lt-'+i);if(el)el.style.display=i===n?'flex':'none';}
  if(n===0)renderLabelDesigns();else renderLabelQueue();
}
function renderLabelDesigns(){
  var el=document.getElementById('lt-0');if(!el)return;
  if(!labelDesigns.length){
    el.innerHTML='<div class="empty"><div class="empty-icon">🖨</div><div class="empty-msg">No label designs yet</div><button class="btn-p" style="margin-top:16px;width:auto;padding:10px 24px;" onclick="openSheet(\'sh-labeldesign\')">+ Create Design</button></div>';
    return;
  }
  var html='<div class="design-grid">';
  labelDesigns.forEach(function(d,i){
    html+='<div class="design-card"><div class="design-card-name">'+esc(d.name)+'</div><div class="design-card-meta">'+esc(d.size)+(d.fields?' · '+d.fields.length+' fields':'')+'</div><div class="design-card-acts"><button class="btn-sm" onclick="editLabelDesign('+i+')">Edit</button><button class="btn-sm" onclick="dupLabelDesign('+i+')">Dup</button><button class="btn-sm" style="color:var(--r);background:var(--rl);" onclick="delLabelDesign('+i+')">Del</button></div></div>';
  });
  html+='</div><button class="btn-s" style="margin-top:12px;" onclick="openSheet(\'sh-labeldesign\')">+ New Design</button>';
  el.innerHTML=html;
}
function renderLabelQueue(){
  var el=document.getElementById('lt-1');if(!el)return;
  var qtab=document.getElementById('l-tab-queue');
  if(qtab)qtab.textContent='Queue'+(labelQueue.length?' ('+labelQueue.length+')':'');
  if(!labelQueue.length){el.innerHTML='<div class="empty"><div class="empty-icon">🗂</div><div class="empty-msg">Queue is empty. Add labels from material variants.</div></div>';return;}
  var html='<div class="card"><div class="sect-hd"><h3>'+labelQueue.length+' labels</h3><button class="btn-ghost" onclick="labelQueue=[];renderLabelQueue();">Clear all</button></div>';
  labelQueue.forEach(function(q,i){
    var m=getMat(q.matId);var v=m&&m.variants[q.varIdx];
    var d=labelDesigns.find(function(x){return x.id===q.designId;});
    html+='<div class="queue-row"><div class="flex-1"><div class="fw-6 fs-13">'+(m?esc(m.name):'')+' · '+(v?esc(v.name):'')+'</div><div class="tx2 fs-12">'+(d?esc(d.name):'Design')+'</div></div>';
    html+='<span class="fw-6">×'+q.qty+'</span><button class="btn-ghost" style="color:var(--r);" onclick="labelQueue.splice('+i+',1);renderLabelQueue();">×</button></div>';
  });
  html+='</div><button class="btn-p" onclick="printAll()">🖨 Print All</button>';
  el.innerHTML=html;
}
function saveLabelDesign(){
  var nm=document.getElementById('ld-name').value.trim();if(!nm){showToast('Enter design name','error');return;}
  var fields=[];
  ['name','var','mrp','offer','sku','barcode','design'].forEach(function(f){if(document.getElementById('ld-f-'+f)&&document.getElementById('ld-f-'+f).checked)fields.push(f);});
  var d={id:uuid(),name:nm,size:document.getElementById('ld-size').value,fields:fields};
  labelDesigns.push(d);closeSheet('sh-labeldesign');renderLabelDesigns();showToast('Design saved');
}
function editLabelDesign(i){
  var d=labelDesigns[i];if(!d)return;
  document.getElementById('ld-name').value=d.name;
  document.getElementById('ld-size').value=d.size;
  openSheet('sh-labeldesign');
}
function dupLabelDesign(i){var d=labelDesigns[i];if(!d)return;labelDesigns.push(Object.assign({},d,{id:uuid(),name:d.name+' (copy)'}));renderLabelDesigns();}
function delLabelDesign(i){if(confirm('Delete this design?')){labelDesigns.splice(i,1);renderLabelDesigns();}}
function openAddLabel(matId,vi){
  _alMatId=matId;_alVi=vi;_alQty=1;
  var m=getMat(matId);var v=m&&m.variants[vi];
  document.getElementById('al-info').textContent=(m?m.name:'')+' · '+(v?v.name:'');
  var html='';
  if(!labelDesigns.length)html='<div class="tx3 fs-13">No designs yet. <button class="btn-ghost" onclick="closeSheet(\'sh-addlabel\');openSheet(\'sh-labeldesign\');">Create one</button></div>';
  labelDesigns.forEach(function(d){html+='<label style="display:flex;align-items:center;gap:8px;padding:8px;border:1.5px solid var(--br);border-radius:10px;cursor:pointer;"><input type="radio" name="al-design" value="'+d.id+'"> <div><div class="fw-6 fs-13">'+esc(d.name)+'</div><div class="tx2 fs-12">'+esc(d.size)+'</div></div></label>';});
  document.getElementById('al-designs').innerHTML=html;
  document.getElementById('al-qty').textContent='1';
  openSheet('sh-addlabel');
}
function alQtyAdj(d){_alQty=Math.max(1,(_alQty||1)+d);document.getElementById('al-qty').textContent=_alQty;}
function addToQueueConfirm(){
  var sel=document.querySelector('input[name="al-design"]:checked');
  if(!sel){showToast('Select a design','error');return;}
  labelQueue.push({matId:_alMatId,varIdx:_alVi,designId:sel.value,qty:_alQty||1});
  closeSheet('sh-addlabel');showToast('Added to queue');
}
function openLabelPreview(matId,vi,designId){
  _lpMatId=matId;_lpVi=vi;_lpDesignId=designId;_lpQty=1;
  document.getElementById('lp-qty').textContent='1';
  var m=getMat(matId);var v=m&&m.variants[vi];
  var d=labelDesigns.find(function(x){return x.id===designId;});
  var html='<div class="label-prev" style="width:200px;">';
  if(d&&d.fields&&d.fields.indexOf('name')>=0)html+='<div style="font-weight:700;font-size:14px;">'+esc(m?m.name:'')+'</div>';
  if(d&&d.fields&&d.fields.indexOf('var')>=0)html+='<div style="font-size:12px;">'+esc(v?v.name:'')+'</div>';
  if(d&&d.fields&&d.fields.indexOf('mrp')>=0)html+='<div style="font-size:13px;">MRP: '+fmtMoney(v?v.mrp:0)+'</div>';
  if(d&&d.fields&&d.fields.indexOf('offer')>=0)html+='<div style="font-size:13px;color:#E24B4A;">Offer: '+fmtMoney(v?v.offer:0)+'</div>';
  if(d&&d.fields&&d.fields.indexOf('sku')>=0)html+='<div style="font-size:11px;color:#888;">'+esc(v?v.sku:'')+'</div>';
  html+='</div>';
  document.getElementById('lp-label').innerHTML=html;
  pushScreen('s-label-preview');
}
function lpQtyAdj(d){_lpQty=Math.max(1,(_lpQty||1)+d);document.getElementById('lp-qty').textContent=_lpQty;}
function doPrint(){showToast('Sent to printer ('+_lpQty+' copies)','info');}
function printAll(){showToast('Sent '+labelQueue.length+' labels to printer','info');}

// ===== COLLECTIONS =====
function renderCollections(){
  var el=document.getElementById('collections-body');if(!el)return;
  if(!collections.length){
    el.innerHTML='<div class="empty"><div class="empty-icon">🗂</div><div class="empty-msg">No collections yet</div><button class="btn-p" style="width:auto;padding:10px 24px;margin-top:16px;" onclick="openNewCollection()">+ New Collection</button></div>';
    return;
  }
  var html='';
  collections.forEach(function(c){
    var cnt=(c.manualIds||[]).length;
    var vis=c.visibility==='public'?'🌐 Public':'🔒 Private';
    html+='<div class="col-card" onclick="openCDetail('+c.id+')">';
    html+='<div class="col-card-hd"><div class="flex-1"><div class="fw-6 fs-14">'+esc(c.name)+'</div><div class="tx2 fs-12">'+cnt+' products · '+vis+'</div></div></div>';
    if(c.desc)html+='<div class="tx2 fs-13 mb-8">'+esc(c.desc)+'</div>';
    html+='</div>';
  });
  el.innerHTML=html;
}
function setColVisibility(v){
  document.getElementById('nc-visibility').value=v;
  document.getElementById('nc-vis-private').className='chip'+(v==='private'?' on':'');
  document.getElementById('nc-vis-public').className='chip'+(v==='public'?' on':'');
}
function openNewCollection(){
  _editColId=null;
  document.getElementById('nc-title').textContent='New Collection';
  document.getElementById('nc-name').value='';
  document.getElementById('nc-desc').value='';
  setColVisibility('private');
  openSheet('sh-newcol');
}
function editCurrentCollection(){
  if(!_editColId)return;
  var c=collections.find(function(x){return x.id===_editColId;});if(!c)return;
  document.getElementById('nc-title').textContent='Edit Collection';
  document.getElementById('nc-name').value=c.name;
  document.getElementById('nc-desc').value=c.desc||'';
  setColVisibility(c.visibility||'private');
  openSheet('sh-newcol');
}
function saveCollection(){
  var nm=document.getElementById('nc-name').value.trim();if(!nm){showToast('Enter collection name','error');return;}
  var desc=document.getElementById('nc-desc').value;
  var visibility=document.getElementById('nc-visibility').value||'private';
  if(_editColId){
    var c=collections.find(function(x){return x.id===_editColId;});
    if(c){c.name=nm;c.desc=desc;c.visibility=visibility;}
  } else {
    collections.push({id:nextId(collections),name:nm,desc:desc,visibility:visibility,tagRules:[],manualIds:[],previewLink:'',previewEnabled:false,previewExpiry:''});
  }
  closeSheet('sh-newcol');renderCollections();showToast('Collection saved');
}
// Product picker state
var _colPickerSearch='';var _colPickerFilter='all';
function openAddProductPicker(){
  _colPickerSearch='';_colPickerFilter='all';
  renderColProductPicker();
  openSheet('sh-col-product-picker');
}
function renderColProductPicker(){
  var search=_colPickerSearch.toLowerCase();
  var c=collections.find(function(x){return x.id===_editColId;});
  var already=c?c.manualIds:[];
  var arr=materials.filter(function(m){
    if(_colPickerFilter==='added')return already.indexOf(m.id)>=0;
    if(_colPickerFilter==='low')return matStockStatus(m)==='low';
    if(_colPickerFilter==='out')return matStockStatus(m)==='out';
    if(_colPickerFilter==='raw')return m.type==='raw';
    if(_colPickerFilter==='finished')return m.type==='finished';
    return true;
  }).filter(function(m){return !search||m.name.toLowerCase().indexOf(search)>=0||m.sku.toLowerCase().indexOf(search)>=0;});
  var el=document.getElementById('cppicker-list');if(!el)return;
  if(!arr.length){el.innerHTML='<div class="tx3 fs-13 text-center" style="padding:16px;">No products match</div>';return;}
  var html='';
  arr.forEach(function(m){
    var inCol=already.indexOf(m.id)>=0;
    var st=matStockStatus(m);
    var stc=st==='ok'?'var(--gl)':st==='low'?'var(--al)':'var(--rl)';
    var stl=st==='ok'?'In stock':st==='low'?'Low stock':'Out of stock';
    html+='<div class="loc-row" style="cursor:pointer;" onclick="toggleColProduct('+m.id+')">';
    html+='<div class="flex-1"><div class="fw-6 fs-13">'+esc(m.name)+'</div><div class="tx2 fs-12">'+esc(m.sku)+' · <span style="color:'+stc+';">'+stl+'</span></div></div>';
    html+='<div style="width:22px;height:22px;border-radius:50%;border:2px solid var(--p);display:flex;align-items:center;justify-content:center;background:'+(inCol?'var(--p)':'transparent')+';color:'+(inCol?'#fff':'transparent')+';">✓</div>';
    html+='</div>';
  });
  el.innerHTML=html;
}
function colPickerSearch(v){_colPickerSearch=v;renderColProductPicker();}
function colPickerFilter(f){_colPickerFilter=f;document.querySelectorAll('#cppicker-filters .chip').forEach(function(b){b.classList.toggle('on',b.getAttribute('data-f')===f);});renderColProductPicker();}
function toggleColProduct(matId){
  var c=collections.find(function(x){return x.id===_editColId;});if(!c)return;
  var idx=c.manualIds.indexOf(matId);
  if(idx>=0)c.manualIds.splice(idx,1);else c.manualIds.push(matId);
  renderColProductPicker();
}
function doneAddingProducts(){closeSheet('sh-col-product-picker');openCDetail(_editColId);}
function openCDetail(id){
  _editColId=id;
  var c=collections.find(function(x){return x.id===id;});if(!c)return;
  document.getElementById('cd-title').textContent=c.name;
  var el=document.getElementById('cdetail-body');
  var mats=materials.filter(function(m){return c.manualIds&&c.manualIds.indexOf(m.id)>=0;});
  var html='<div class="card"><div class="sect-hd"><h3>'+mats.length+' Products</h3><button class="btn-sm" onclick="openAddProductPicker()">+ Add</button></div>';
  if(!mats.length)html+='<div class="tx3 text-center fs-13" style="padding:16px;">No products yet. Tap + Add to include materials.</div>';
  mats.forEach(function(m){
    var st=matStockStatus(m);var stc=st==='ok'?'var(--gl)':st==='low'?'var(--al)':'var(--rl)';
    html+='<div class="loc-row"><div class="fw-6 fs-13 flex-1">'+esc(m.name)+'<span style="font-size:11px;color:'+stc+';margin-left:6px;">●</span></div><button class="btn-ghost" style="color:var(--r);" onclick="removeFromCollection('+m.id+')">×</button></div>';
  });
  html+='</div>';
  // Share link card
  var linkExpired=c.previewEnabled&&c.previewExpiry&&new Date(c.previewExpiry)<new Date();
  html+='<div class="card"><div class="sect-hd"><h3>Share Link</h3><span class="chip '+(c.previewEnabled?(linkExpired?'chip-out':'chip-ok'):'chip-low')+'">'+(c.previewEnabled?(linkExpired?'Expired':'Active'):'Off')+'</span></div>';
  if(c.previewEnabled&&c.previewLink){
    html+='<div style="display:flex;gap:6px;align-items:center;margin-bottom:8px;"><input type="text" value="'+esc(c.previewLink)+'" readonly style="flex:1;font-size:12px;color:var(--tx2);"><button class="btn-sm" onclick="copyShareLink()">Copy</button></div>';
    if(c.previewExpiry)html+='<div class="tx3 fs-12">Expires: '+esc(c.previewExpiry)+(linkExpired?' <strong style="color:var(--r);">(Expired)</strong>':'')+'</div>';
  }
  html+='<button class="btn-sm" style="margin-top:8px;width:100%;" onclick="openShareLinkSheet()">⚙ Share settings</button>';
  html+='</div>';
  el.innerHTML=html;
  pushScreen('s-cdetail');
}
function removeFromCollection(matId){var c=collections.find(function(x){return x.id===_editColId;});if(c)c.manualIds=c.manualIds.filter(function(i){return i!==matId;});openCDetail(_editColId);}
function openShareLinkSheet(){
  var c=collections.find(function(x){return x.id===_editColId;});if(!c)return;
  var el=document.getElementById('sl-enabled');if(el)el.checked=!!c.previewEnabled;
  var urlEl=document.getElementById('sl-url');if(urlEl)urlEl.value=c.previewLink||'';
  var expEl=document.getElementById('sl-expiry');if(expEl)expEl.value=c.previewExpiry||'';
  document.getElementById('sl-link-section').style.display=c.previewEnabled?'block':'none';
  openSheet('sh-sharelink');
}
function slToggle(){
  var on=document.getElementById('sl-enabled').checked;
  var c=collections.find(function(x){return x.id===_editColId;});if(!c)return;
  if(on&&!c.previewLink)c.previewLink='https://boutiqbiz.com/preview/'+uuid();
  document.getElementById('sl-link-section').style.display=on?'block':'none';
  if(on){var urlEl=document.getElementById('sl-url');if(urlEl)urlEl.value=c.previewLink;}
}
function slRegenerate(){
  var c=collections.find(function(x){return x.id===_editColId;});if(!c)return;
  if(!confirm('Regenerate link? The old link will stop working.'))return;
  c.previewLink='https://boutiqbiz.com/preview/'+uuid();
  var urlEl=document.getElementById('sl-url');if(urlEl)urlEl.value=c.previewLink;
  showToast('Link regenerated');
}
function copyShareLink(){
  var c=collections.find(function(x){return x.id===_editColId;});
  var link=c&&c.previewLink;if(!link)return;
  if(navigator.clipboard)navigator.clipboard.writeText(link).then(function(){showToast('Link copied');});
  else{var t=document.createElement('textarea');t.value=link;document.body.appendChild(t);t.select();document.execCommand('copy');document.body.removeChild(t);showToast('Link copied');}
}
function saveShareLink(){
  var c=collections.find(function(x){return x.id===_editColId;});if(!c)return;
  c.previewEnabled=document.getElementById('sl-enabled').checked;
  c.previewExpiry=document.getElementById('sl-expiry').value||'';
  if(c.previewEnabled&&!c.previewLink)c.previewLink='https://boutiqbiz.com/preview/'+uuid();
  closeSheet('sh-sharelink');openCDetail(_editColId);showToast('Share settings saved');
}

// ===== CHANNEL LISTINGS =====
function renderChFilterRow(){
  var el=document.getElementById('ch-filter-row');if(!el)return;
  var html='<button class="ch-chip'+(!_chFilter?' on':'')+'" onclick="setChFilter(\'\')">All</button>';
  channels.forEach(function(c){html+='<button class="ch-chip'+(_chFilter===c.id?' on':'')+'" onclick="setChFilter(\''+c.id+'\')">'+c.icon+' '+esc(c.name)+'</button>';});
  el.innerHTML=html;
}
function setChFilter(id){_chFilter=id;renderChFilterRow();renderListings();}
function renderListings(){
  var el=document.getElementById('listings-body');if(!el)return;
  var arr=channelListings.filter(function(l){return !_chFilter||l.channelId===_chFilter;});
  if(!arr.length){
    el.innerHTML='<div class="empty"><div class="empty-icon">🌐</div><div class="empty-msg">No listings yet. Create a listing to publish products to your sales channels.</div><button class="btn-p" style="width:auto;padding:10px 24px;margin-top:16px;" onclick="openListingDetail(null)">+ New Listing</button></div>';
    return;
  }
  var html='';
  arr.forEach(function(l){
    var m=getMat(l.matId);
    var ch=channels.find(function(c){return c.id===l.channelId;})||{name:l.channelId,icon:'🌐'};
    html+='<div class="listing-card" onclick="openListingDetail('+l.id+')">';
    html+='<div class="row-between mb-8"><div><span style="font-size:18px;">'+ch.icon+'</span> <span class="fw-6">'+esc(ch.name)+'</span></div><span class="chip chip-'+l.status+'">'+l.status+'</span></div>';
    html+='<div class="fw-6 fs-14 mb-4">'+esc(m?m.name:'Unknown material')+'</div>';
    html+='<div class="tx2 fs-13">'+esc(l.listingTitle||'(no title)')+'</div>';
    html+='<div class="tx3 fs-12 mb-4">'+l.availableVariants.length+' variants available</div>';
    html+='</div>';
  });
  el.innerHTML=html;
}
function openListingDetail(listingId,prefillMatId){
  _editListingId=listingId;
  var l=listingId?channelListings.find(function(x){return x.id===listingId;}):null;
  document.getElementById('ld-title').textContent=l?'Edit Listing':'New Listing';
  var el=document.getElementById('listing-detail-body');
  var html='';
  // Product & Channel
  html+='<div class="card"><div class="sect-hd"><h3>Product & Channel</h3></div>';
  html+='<div class="fld"><label>Material</label><select id="ldm-mat" onchange="ldUpdateVariants()">';
  html+='<option value="">Select material…</option>';
  materials.forEach(function(m){html+='<option value="'+m.id+'"'+(l&&l.matId===m.id?' selected':(prefillMatId===m.id?' selected':'')+'')+'>'+esc(m.name)+'</option>';});
  html+='</select></div>';
  html+='<div class="fld"><label>Channel</label><div style="display:flex;flex-wrap:wrap;gap:6px;margin-top:6px;" id="ldm-channels">';
  channels.forEach(function(c){html+='<button class="ch-chip'+((l&&l.channelId===c.id)||(!l&&c.id==='shopify')?' on':'')+'" onclick="selectLdChannel(\''+c.id+'\')">'+c.icon+' '+esc(c.name)+'</button>';});
  html+='</div></div>';
  html+='<div class="fld"><label>Status</label><select id="ldm-status"><option value="draft"'+((!l||l.status==='draft')?' selected':'')+'>Draft</option><option value="active"'+(l&&l.status==='active'?' selected':'')+'>Active</option><option value="paused"'+(l&&l.status==='paused'?' selected':'')+'>Paused</option><option value="delisted"'+(l&&l.status==='delisted'?' selected':'')+'>Delisted</option></select></div>';
  html+='</div>';
  // Variant availability
  html+='<div class="card"><div class="sect-hd"><h3>Variant Availability</h3></div><div id="ldm-variants"><p class="tx3 fs-13">Select a material first</p></div></div>';
  // Content
  html+='<div class="card"><div class="sect-hd"><h3>Listing Content</h3><button class="btn-sm" onclick="generateListingContent()" style="background:var(--pl);color:var(--pt);">✨ Generate with AI</button></div>';
  html+='<div class="fld"><label>Title</label><input type="text" id="ldm-title" value="'+esc(l?l.listingTitle:'')+'"></div>';
  html+='<div class="fld"><label>Description</label><textarea id="ldm-desc" rows="3">'+esc(l?l.listingDesc:'')+'</textarea></div>';
  html+='<div class="fld"><label>Bullet Points</label><div id="ldm-bullets">';
  var bullets=l?l.bullets:['','',''];
  bullets.forEach(function(b,i){html+='<div class="bullet-row"><span style="color:var(--tx3);">•</span><input type="text" value="'+esc(b)+'" id="ldm-b-'+i+'" placeholder="Feature bullet '+(i+1)+'"></div>';});
  html+='</div><button class="btn-ghost" onclick="addBullet()">+ Add bullet</button>';
  html+='</div></div>';
  // Attributes
  html+='<div class="card"><div class="sect-hd"><h3>Attributes</h3></div>';
  html+='<div class="fld"><label>Category</label><input type="text" id="ldm-cat" value="'+esc(l&&l.attributes?l.attributes.category:'')+'"></div>';
  html+='<div class="fld"><label>Fabric Composition</label><input type="text" id="ldm-fabric" value="'+esc(l&&l.attributes?l.attributes.fabric:'')+'"></div>';
  html+='<div class="fld"><label>Care Instructions</label><input type="text" id="ldm-care" value="'+esc(l&&l.attributes?l.attributes.care:'')+'"></div>';
  html+='<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">'+
    '<div class="fld"><label>HSN Code</label><input type="text" id="ldm-hsn" value="'+esc(l&&l.attributes?l.attributes.hsnCode:'')+'"></div>'+
    '<div class="fld"><label>Country of Origin</label><input type="text" id="ldm-origin" value="'+esc(l&&l.attributes?l.attributes.countryOfOrigin:'India')+'"></div>';
  html+='</div></div>';
  html+='<div style="display:flex;gap:8px;"><button class="btn-s" style="flex:1;" onclick="saveListing(false)">Save Draft</button><button class="btn-g" style="flex:1;" onclick="saveListing(true)">Publish</button></div>';
  el.innerHTML=html;
  // Trigger variant load if mat pre-selected
  setTimeout(function(){ldUpdateVariants();},50);
  pushScreen('s-listing-detail');
}
function ldUpdateVariants(){
  var sel=document.getElementById('ldm-mat');
  var el=document.getElementById('ldm-variants');if(!el)return;
  var matId=sel&&parseInt(sel.value);
  var m=matId?getMat(matId):null;
  if(!m){el.innerHTML='<p class="tx3 fs-13">Select a material first</p>';return;}
  var l=_editListingId?channelListings.find(function(x){return x.id===_editListingId;}):null;
  var avail=l?l.availableVariants:m.variants.map(function(_,i){return i;});
  var html='<div style="display:flex;flex-direction:column;gap:6px;">';
  m.variants.forEach(function(v,i){
    var checked=avail.indexOf(i)>=0;
    html+='<label style="display:flex;align-items:center;gap:8px;padding:8px;border:1.5px solid var(--br);border-radius:8px;"><input type="checkbox" value="'+i+'" id="ldv-'+i+'"'+(checked?' checked':'')+'>'+
      '<div class="var-swatch" style="background:'+v.color+'"></div>'+
      '<div class="flex-1"><div class="fw-6 fs-13">'+esc(v.name)+'</div><div class="tx2 fs-12">Stock: '+v.qty+'</div></div></label>';
  });
  html+='</div>';
  el.innerHTML=html;
}
function selectLdChannel(id){
  document.querySelectorAll('#ldm-channels .ch-chip').forEach(function(btn){btn.classList.toggle('on',btn.onclick.toString().indexOf("'"+id+"'")>=0||btn.getAttribute('onclick')==="selectLdChannel('"+id+"')");});
  document.querySelectorAll('#ldm-channels .ch-chip').forEach(function(btn){btn.classList.remove('on');});
  var btns=document.querySelectorAll('#ldm-channels .ch-chip');
  btns.forEach(function(b){if(b.getAttribute('onclick')==="selectLdChannel('"+id+"')")b.classList.add('on');});
}
function generateListingContent(){
  var sel=document.getElementById('ldm-mat');
  var matId=sel&&parseInt(sel.value);
  var m=matId?getMat(matId):null;
  if(!m){showToast('Select a material first','error');return;}
  var title=m.name+' — Premium Quality';
  var desc=m.desc||'High-quality '+m.name+' crafted for the discerning fashion customer. Made in India.';
  var bullets=['Material: Premium '+m.unit,'Available in multiple sizes and colours','Easy care and maintenance','Designed and made in India','Ideal for casual and festive occasions'];
  document.getElementById('ldm-title').value=title;
  document.getElementById('ldm-desc').value=desc;
  bullets.forEach(function(b,i){var el=document.getElementById('ldm-b-'+i);if(el)el.value=b;});
  showToast('Content generated with AI ✨');
}
function addBullet(){
  var cnt=document.querySelectorAll('#ldm-bullets .bullet-row').length;
  var html='<div class="bullet-row"><span style="color:var(--tx3);">•</span><input type="text" id="ldm-b-'+cnt+'" placeholder="Feature bullet '+(cnt+1)+'"></div>';
  document.getElementById('ldm-bullets').insertAdjacentHTML('beforeend',html);
}
function saveListing(publish){
  var matId=parseInt((document.getElementById('ldm-mat')||{}).value)||0;
  if(!matId){showToast('Select a material','error');return;}
  var chOn=document.querySelector('#ldm-channels .ch-chip.on');
  var channelId=chOn?chOn.getAttribute('onclick').replace("selectLdChannel('","").replace("')",''):'shopify';
  var avail=[];
  document.querySelectorAll('#ldm-variants input[type=checkbox]').forEach(function(cb){if(cb.checked)avail.push(parseInt(cb.value));});
  var bullets=[];
  document.querySelectorAll('#ldm-bullets input').forEach(function(i){if(i.value.trim())bullets.push(i.value.trim());});
  var l={
    id:_editListingId||nextId(channelListings),
    matId:matId,channelId:channelId,
    status:publish?'active':(document.getElementById('ldm-status').value||'draft'),
    listingTitle:(document.getElementById('ldm-title')||{}).value||'',
    listingDesc:(document.getElementById('ldm-desc')||{}).value||'',
    bullets:bullets,
    availableVariants:avail,
    channelPricing:[],
    attributes:{category:(document.getElementById('ldm-cat')||{}).value||'',fabric:(document.getElementById('ldm-fabric')||{}).value||'',care:(document.getElementById('ldm-care')||{}).value||'',hsnCode:(document.getElementById('ldm-hsn')||{}).value||'',countryOfOrigin:(document.getElementById('ldm-origin')||{}).value||'India'},
    aiGenerated:false,createdAt:todayStr(),updatedAt:todayStr()
  };
  if(_editListingId){var idx=channelListings.findIndex(function(x){return x.id===_editListingId;});if(idx>=0)channelListings[idx]=l;}
  else channelListings.push(l);
  renderListings();showToast(publish?'Listing published':'Saved as draft');goBack();
}

// ===== ORDER REQUESTS =====
function renderOrderRequests(filter){
  var el=document.getElementById('or-body');if(!el)return;
  var arr=orderRequests.filter(function(r){return !filter||r.status===filter;});
  if(!arr.length){el.innerHTML='<div class="empty"><div class="empty-icon">📋</div><div class="empty-msg">No '+(filter||'')+ ' requests</div></div>';return;}
  var html='';
  arr.forEach(function(r){
    var m=getMat(r.matId);
    html+='<div class="req-row" onclick="openRequestDetail('+r.id+')">';
    html+='<div class="row-between mb-4"><span class="fw-6 fs-14">'+esc(r.clientName)+'</span><span class="chip chip-'+(r.status==='pending'?'low':r.status==='converted'?'ok':'out')+'">'+r.status+'</span></div>';
    html+='<div class="tx2 fs-13">'+(m?esc(m.name):'')+' · '+esc(r.variantName)+'</div>';
    html+='<div class="tx3 fs-12">'+esc(r.requestDate)+'</div>';
    html+='</div>';
  });
  el.innerHTML=html;
}
function openRequestDetail(id){
  var r=orderRequests.find(function(x){return x.id===id;});if(!r)return;
  var m=getMat(r.matId);
  var html='<div class="card">'+
    '<div class="fld"><label>Client</label><div class="fw-6">'+esc(r.clientName)+'</div><div class="tx2 fs-12">'+esc(r.clientContact)+'</div></div>'+
    '<div class="fld"><label>Product</label><div class="fw-6">'+(m?esc(m.name):'')+' · '+esc(r.variantName)+'</div></div>'+
    '<div class="fld"><label>Date</label><div>'+esc(r.requestDate)+'</div></div>'+
    '<div class="fld"><label>Status</label><span class="chip chip-low">'+r.status+'</span></div>'+
    '</div>';
  if(r.status==='pending'){
    html+='<button class="btn-p" onclick="updateReqStatus('+r.id+',\'acknowledged\')">Acknowledge</button>';
    html+='<button class="btn-s" style="margin-top:8px;" onclick="updateReqStatus('+r.id+',\'rejected\')">Reject</button>';
  }else if(r.status==='acknowledged'){
    html+='<button class="btn-p" onclick="updateReqStatus('+r.id+',\'converted\')">Convert to Order</button>';
  }
  document.getElementById('rd-body').innerHTML=html;
  openSheet('sh-request-detail');
}
function updateReqStatus(id,status){
  var r=orderRequests.find(function(x){return x.id===id;});if(r)r.status=status;
  closeSheet('sh-request-detail');renderOrderRequests('');showToast('Status updated');
}

// ===== SETTINGS =====
function renderOptionSets(){
  var el=document.getElementById('oset-list');if(!el)return;
  var html='';
  optionSets.forEach(function(os){
    html+='<div class="oset-row"><div><div class="fw-6 fs-13">'+esc(os.name)+'</div><div class="tx2 fs-12">'+os.values.join(', ')+'</div></div>';
    html+='<div style="display:flex;gap:6px;"><button class="btn-sm" onclick="openEditOptionSet(\''+os.id+'\')">Edit</button><button class="btn-sm" style="color:var(--r);background:var(--rl);" onclick="deleteOptionSet(\''+os.id+'\')">Del</button></div></div>';
  });
  el.innerHTML=html;
}
function openNewOptionSet(){_editListingId=null;document.getElementById('ns-title').textContent='New Option Set';document.getElementById('ns-name').value='';document.getElementById('ns-values').value='';openSheet('sh-newset');}
function openEditOptionSet(id){var os=optionSets.find(function(o){return o.id===id;});if(!os)return;window._editOsId=id;document.getElementById('ns-title').textContent='Edit Option Set';document.getElementById('ns-name').value=os.name;document.getElementById('ns-values').value=os.values.join(', ');openSheet('sh-newset');}
function saveOptionSet(){
  var nm=document.getElementById('ns-name').value.trim();if(!nm){showToast('Enter name','error');return;}
  var vals=document.getElementById('ns-values').value.split(',').map(function(v){return v.trim();}).filter(Boolean);
  if(window._editOsId){var os=optionSets.find(function(o){return o.id===window._editOsId;});if(os){os.name=nm;os.values=vals;}}
  else optionSets.push({id:'os-'+uuid(),name:nm,values:vals});
  window._editOsId=null;closeSheet('sh-newset');renderOptionSets();showToast('Saved');
}
function deleteOptionSet(id){if(!confirm('Delete this option set?'))return;optionSets=optionSets.filter(function(o){return o.id!==id;});renderOptionSets();}


// ===== INIT =====
document.addEventListener('DOMContentLoaded',function(){
  renderViewsBar();
  renderList();
});

</script>
</body>
</html>
