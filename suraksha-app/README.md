# Suraksha Platform — working prototype

Laravel 12 app with Indian sample data. Two logins:

| Side | URL | Email | Password |
| --- | --- | --- | --- |
| Suraksha team (admin) | `/login` | admin@suraksha.demo | Suraksha@2026 |
| Client portal (Eastern Castings) | `/portal/login` | client@easterncastings.demo | Client@2026 |

All clients, policies, people and numbers are invented. Nothing comes from Suraksha.

## What's in it

**Team side**
- **Dashboard (for Nitesh):** premium written this FY and growth vs last year, commission, policies in force, renewal retention, renewals due in 30/60/90 days and at risk, sales pipeline and win rate, open claims, monthly premium chart, premium by line / insurer / segment, RM targets vs achievement.
- **CRM & leads:** board and list views, stages New → Contacted → Meeting → Quotation → Won / Lost, activity log, follow-up dates, POSP-sourced leads, convert a won lead to a client.
- **Quotations:** for new business or renewals. Add each insurer's quote **by hand** or **upload the insurer's PDF and let AI read it** (you review before it's added). Compare side by side, mark "Recommended by Suraksha", hide options, send to the client portal, record approval.
- **Renewals:** everything expiring in 15–120 days, stage counts, at-risk flags, owner and next step; marking "Renewed" creates the new policy from the approved quote.
- **Clients, policies, claims:** client 360° view, create client portal logins, claim tracker with status updates (public or internal).
- **Team & POSP agents:** add team members (roles, targets, login on/off); add POSPs with KYC, training hours, exam and certificate (certification blocked until 15 hours + exam passed).
- **Settings:** Anthropic API key and model for AI quote reading; insurer list with API status.

**Client portal**
- Overview, my policies (filter by category), upcoming renewals with plain-English status.
- Quotes to compare and approve, with Suraksha's recommendation and reason.
- Report a claim with photos / PDFs, then follow every stage and update.

## Run it on your Mac (MAMP or plain PHP)

Needs PHP 8.2 or 8.3 with `pdo_sqlite`, `mbstring`, `openssl`, `fileinfo`. The `vendor` folder is included, so no Composer step is needed.

```
cd suraksha-platform
php artisan serve
```

Open http://127.0.0.1:8000. With MAMP, point the document root at the `public` folder (and make sure Apache `mod_rewrite` is on).

## Put it on the server (cPanel)

1. Create a subdomain, for example `suraksha.systemsbyad.com`.
2. Upload and extract the zip one level above the web root, e.g. `/home/USER/suraksha-platform`.
3. Set the subdomain's **document root** to `/home/USER/suraksha-platform/public`. (If you can't, put the files in the subdomain folder: the root `.htaccess` forwards to `public/`.)
4. Select PHP 8.3 for the subdomain (MultiPHP Manager) with `pdo_sqlite` enabled.
5. Make `storage/`, `bootstrap/cache/` and `database/` writable (755; the SQLite file 664).
6. In `.env`, set `APP_URL=https://suraksha.systemsbyad.com`. Keep `APP_DEBUG=false`.
7. Add `robots.txt` with `Disallow: /` if the demo shouldn't be indexed (already blocks nothing by default).

## AI quote reading

Settings → paste an Anthropic API key → Save → Test connection. Then open any quotation and use **Read with AI**. Three sample insurer quote PDFs are in `public/samples/` to try (ICICI Lombard, New India, HDFC ERGO — marked "sample – demo only"). The PDF is sent to Anthropic's API; usage is billed to the key's account (roughly ₹1–3 per document). Without a key, everything else works and manual entry is available.

## Reset the demo data

```
php artisan migrate:fresh --seed
```

Dates are generated relative to today, so renewals and claims always look current.

## Not in this prototype (part of the full build)

Role-based access for each user level (RMs seeing only their own clients), commission statement reconciliation, IRDAI reports, WhatsApp and email sending, insurer / TPA API integrations, document storage per policy, GMC employee portal, policy PDF reading, and the approval queue.

## Technical notes

- Laravel 12.71, PHP 8.2+, SQLite (switch to MySQL by changing `DB_*` in `.env` and running `php artisan migrate --seed`).
- No front-end build step: plain Blade views, one CSS file (`public/css/app.css`) and Chart.js bundled locally.
- Uploaded quote PDFs and claim files are stored privately in `storage/app/private`, served only to signed-in users.
- Every client portal query is limited to the signed-in client's own company.
