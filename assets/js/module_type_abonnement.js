
loadDataTable('data-table-type_abonnement', '#data-table-type_abonnement', 'charger_data_type_abonnements');

// Suppression
Supprimer({
    deleteClass: ".typeAbonnementDelete",
    dataAttribute: "typeabonnement",
    actionDelete: "btn_delete_type_abonnement",
    codeParam: "code_type_abonnement",
    tableId: "data-table-type_abonnement"
});

// Ouverture modal modification
OpenModalUpdate({
    updateClass: ".frmModifierTypeAbonnement",
    dataAttribute: "typeabonnement",
    actionUpdate: "modal_modifier_type_abonnement",
    modalId: "#type_abonnement-modal"
});

// Ouverture modal ajout
OpenModalAdd({
    addBtnId: "#TypeAbonnementAddModal",
    actionAdd: "btn_showmodal_type_abonnement",
    modalId: "#type_abonnement-modal"
});

// Soumission formulaire ajout/modification
Ajouter({
    formId: "#frmAddTypeAbonnement",
    submitBtnId: "#btn_ajouter_type_abonnement",
    tableId: "data-table-type_abonnement",
    modalId: "#type_abonnement-modal"
});
// Soumission formulaire ajout/modification
Ajouter({
    formId: "#formUpdateTypeAbonnement",
    submitBtnId: "#btn_modifier_type_abonnement",
    tableId: "data-table-type_abonnement",
    modalId: "#type_abonnement-modal"
});


