// ==========================================
// Partner Module
// ==========================================

// Chargement DataTable
loadDataTable('data-table-partner', '#data-table-partner', 'charger_data_partner');

// Suppression partner
Supprimer({
    deleteClass: ".partnerDelete",
    dataAttribute: "partner",
    actionDelete: "btn_delete_partner",
    codeParam: "code_partner",
    tableId: "data-table-partner"
});

// Ouverture modal modification partner
OpenModalUpdate({
    updateClass: ".frmModifierPartner",
    dataAttribute: "partner",
    actionUpdate: "modal_modifier_partner",
    modalId: "#partner-modal"
});

// Ouverture modal ajout partner
OpenModalAdd({
    addBtnId: "#PartnerAddModal",
    actionAdd: "btn_showmodal_partner",
    modalId: "#partner-modal"
});

// Soumission formulaire ajout partner
Ajouter({
    formId: "#formAddPartner",
    submitBtnId: "#btn_ajouter_partner",
    tableId: "data-table-partner",
    modalId: "#partner-modal"
});

// Soumission formulaire modification partner
Ajouter({
    formId: "#formUpdatePartner",
    submitBtnId: "#btn_modifier_partner",
    tableId: "data-table-partner",
    modalId: "#partner-modal"
});
