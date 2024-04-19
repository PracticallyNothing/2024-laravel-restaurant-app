import "./bootstrap";

function get_csrf_token() {
    return document.query_selector("meta[name=csrf_token]").attributes[
        "content"
    ];
}

function reserve_table(event, table_id) {
    if (table_id == null) {
        return;
    }

    alert(table_id);
}
