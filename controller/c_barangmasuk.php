<?php


if (isset($_POST["keyword_bahan_masuk"])) {
    $keyword = $_POST["keyword_bahan_masuk"];

    $item_po = query("SELECT * FROM item_po
    JOIN bahan ON item_po.kodebahan = bahan.kodebahan 
    WHERE  No_form = '$keyword'
    ORDER BY item_po.id DESC ");

    $detail = query("SELECT form_po.kodesupplier,namasupplier,alamatsupplier,No_form FROM form_po
    JOIN supplier ON form_po.kodesupplier = supplier.kodesupplier 
    WHERE  No_form = '$keyword'
    ORDER BY form_po.id DESC ")[0];
}
