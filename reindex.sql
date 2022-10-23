CREATE INDEX ps_product_ref ON ps_product(reference);
CREATE INDEX ps_stock_id ON ps_stock_available(id_product);
CREATE INDEX ps_product_id ON ps_product(id_product);
