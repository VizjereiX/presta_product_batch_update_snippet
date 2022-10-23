# presta_product_batch_update_snippet
It is small snippet showing how to use batch update for big number of small changes in DB (temporary table, loading file into db etc)

1. Create database with schema.sql.
2. Generate sample data using `php generate.php`;
3. Re-index your data! (use index.sql).
4. Do the batch update using `php update.php`.
