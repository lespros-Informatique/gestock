
loadDataTable('data-table-application', '#data-table-application', 'charger_data_applications');

// Suppression application
Supprimer({
    deleteClass: ".applicationDeleteApplication",
    dataAttribute: "application",
    actionDelete: "btn_delete_application",
    codeParam: "code_application",
    tableId: "data-table-application"
});

// Ouverture modal modification application
OpenModalUpdate({
    updateClass: ".frmModifierApplication",
    dataAttribute: "application",
    actionUpdate: "modal_modifier_application",
    modalId: "#application-modal"
});

// Ouverture modal ajout application
OpenModalAdd({
    addBtnId: "#ApplicationAddModal",
    actionAdd: "btn_showmodal_application",
    modalId: "#application-modal"
});

// Soumission formulaire ajout application AVEC fichier
AjouterAvecFichier({
    formId: "#frmAddApplication",
    submitBtnId: "#btn_ajouter_application",
    tableId: "data-table-application",
    modalId: "#application-modal"
});

// Soumission formulaire modification application AVEC fichier
AjouterAvecFichier({
    formId: "#formUpdateApplication",
    submitBtnId: "#btn_modifier_application",
    tableId: "data-table-application",
    modalId: "#application-modal"
});
