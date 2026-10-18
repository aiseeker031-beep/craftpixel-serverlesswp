# Craftpixel digital storefront — safe launch

This ServerlessWP change adds an MU-plugin catalog without replacing the active theme, homepage, existing pages, or database content.

## Added
- Shortcode `[craftpixel_store]`; create a WordPress “Shop” page and add it there.
- WooCommerce product cards, product detail links, category filtering, search and pagination.
- Responsive premium-minimal design.
- Safe launch gate: purchase actions and payment gateways stay disabled unless `CRAFTPIXEL_ENABLE_CHECKOUT` is explicitly defined as boolean true in WordPress configuration. Do not enable until all checks pass.
- No sample/fake products, content edits, DB migrations, payment credentials or deployment.

## Production checklist
1. Provision a dedicated production MySQL 8+ or MariaDB 10.6+ database with TLS and a backup plan.
2. Configure sensitive Vercel production variables `DATABASE`, `USERNAME`, `PASSWORD`, and `HOST`. Verify the runtime uses MySQL before writing or migrating data. Do not point at an existing database without backup and schema ownership review.
3. Test on a preview first: WordPress admin/login, product reads, concurrent writes and persistent order data. Do not switch an existing SQLite/Blob site to an empty DB without a documented migration.
4. Install and activate WooCommerce compatible with the current runtime. ServerlessWP defines `DISALLOW_FILE_MODS`; use a supported repository/deployment workflow to package plugin code.
5. Upload real licensed digital products. Keep paid files in private storage; verify unpaid visitors cannot access files and purchases grant access only after verified payment.
6. Configure a payment provider available to the business, credentials in sensitive environment variables, and signed webhooks. Test idempotency, successful/failed/duplicate events, refunds and receipts.
7. Verify end-to-end orders persist in MySQL and failed/duplicate events never grant downloads.
8. Only after all checks pass, explicitly enable `define('CRAFTPIXEL_ENABLE_CHECKOUT', true);` and run final preview tests. The constant alone does not prove payment readiness.
9. Back up existing data and obtain approval before production promotion.

The catalog can launch as a showcase before payments, but purchasing remains disabled by design. Do not advertise payments as live until end-to-end verification.
