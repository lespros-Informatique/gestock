
loadDataTable('data-table-avantage', '#data-table-avantage', 'charger_data_avantage');

// Suppression
Supprimer({
    deleteClass: ".avantageDelete",
    dataAttribute: "avantage",
    actionDelete: "btn_delete_avantage",
    codeParam: "code_avantage",
    tableId: "data-table-avantage"
});

// Ouverture modal modification
OpenModalUpdate({
    updateClass: ".frmModifierAvantage",
    dataAttribute: "avantage",
    actionUpdate: "modal_modifier_avantage",
    modalId: "#avantage-modal"
});

// Ouverture modal ajout
OpenModalAdd({
    addBtnId: "#avantageAddModal",
    actionAdd: "btn_showmodal_avantage",
    modalId: "#avantage-modal"
});

// Soumission formulaire ajout
Ajouter({
    formId: "#frmAddAvantage",
    submitBtnId: "#btn_ajouter_avantage",
    tableId: "data-table-avantage",
    modalId: "#avantage-modal"
});

// Soumission formulaire modification
Ajouter({
    formId: "#formUpdateAvantage",
    submitBtnId: "#btn_modifier_avantage",
    tableId: "data-table-avantage",
    modalId: "#avantage-modal"
});
