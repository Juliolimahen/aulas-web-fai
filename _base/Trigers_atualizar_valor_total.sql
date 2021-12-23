CREATE TRIGGER `TR_ATT_VT_ENCOMENDAS` AFTER INSERT ON `itens_encomenda`
 FOR EACH ROW BEGIN
    UPDATE encomendas 
        set valor_total = valor_total + (NEW.valor_unitario * NEW.quantidade)
        where num_encomenda = NEW.num_encomenda;
END


CREATE TRIGGER `TR_DEL_VT_ENCOMENDAS` BEFORE DELETE ON `itens_encomenda`
 FOR EACH ROW BEGIN
    UPDATE encomendas 
        set valor_total = valor_total -(OLD.valor_unitario * OLD.quantidade)
        where num_encomenda = OLD.num_encomenda;
END