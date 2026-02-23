// Chargement des données du dashboard au chargement de la page
$(document).ready(function() {
    loadDashboardData();
});

/**
 * Charger toutes les données du dashboard
 */
function loadDashboardData() {
    loadStatistiques();
    loadAbonnementsChart();
    loadRevenusChart();
    loadTypesAbonnements();
    loadDerniersAbonnements();
    loadPartenairesRecents();
}

/**
 * Charger les statistiques générales
 */
function loadStatistiques() {
    $.ajax({
        url: URL_AJAX,
        method: 'POST',
        data: {
            controller: 'Dashboard',
            action: 'getStatistiques'
        },
        dataType: 'JSON',
        success: function(response) {
            if (response.code === 200) {
                const data = response.data;
                
                // Animation des chiffres
                animateValue('total-applications', 0, data.totalApplications, 1000);
                animateValue('total-partenaires', 0, data.totalPartenaires, 1000);
                animateValue('total-clients', 0, data.totalClients, 1000);
                animateValue('total-abonnements', 0, data.totalAbonnements, 1000);
                
                // Formatage des montants
                $('#revenu-mois').text(formatMoney(data.revenuMoisEnCours));
                $('#revenu-total').text(formatMoney(data.revenuTotal));
            }
        }
    });
}

/**
 * Charger le graphique des abonnements
 */
function loadAbonnementsChart() {
    $.ajax({
        url: URL_AJAX,
        method: 'POST',
        data: {
            controller: 'Dashboard',
            action: 'getAbonnementsChart',
            annee: new Date().getFullYear()
        },
        dataType: 'JSON',
        success: function(response) {
            if (response.code === 200) {
                renderAbonnementsChart(response.labels, response.data);
            }
        }
    });
}

/**
 * Charger le graphique des revenus
 */
function loadRevenusChart() {
    $.ajax({
        url: URL_AJAX,
        method: 'POST',
        data: {
            controller: 'Dashboard',
            action: 'getRevenusChart',
            annee: new Date().getFullYear()
        },
        dataType: 'JSON',
        success: function(response) {
            if (response.code === 200) {
                renderRevenusChart(response.labels, response.data);
            }
        }
    });
}

/**
 * Charger les types d'abonnements populaires
 */
function loadTypesAbonnements() {
    $.ajax({
        url: URL_AJAX,
        method: 'POST',
        data: {
            controller: 'Dashboard',
            action: 'getTypesPopulaires'
        },
        dataType: 'JSON',
        success: function(response) {
            if (response.code === 200) {
                $('#types-abonnements').html(response.data);
            }
        }
    });
}

/**
 * Charger les derniers abonnements
 */
function loadDerniersAbonnements() {
    $.ajax({
        url: URL_AJAX,
        method: 'POST',
        data: {
            controller: 'Dashboard',
            action: 'getDerniersAbonnements',
            limit: 5
        },
        dataType: 'JSON',
        success: function(response) {
            if (response.code === 200) {
                $('#derniers-abonnements').html(response.data);
            }
        }
    });
}

/**
 * Charger les partenaires récents
 */
function loadPartenairesRecents() {
    $.ajax({
        url: URL_AJAX,
        method: 'POST',
        data: {
            controller: 'Dashboard',
            action: 'getPartenairesRecents',
            limit: 5
        },
        dataType: 'JSON',
        success: function(response) {
            if (response.code === 200) {
                $('#partenaires-recents').html(response.data);
            }
        }
    });
}

// ========================
// Graphiques Chart.js
// ========================

let abonnementsChart = null;
let revenusChart = null;

/**
 * Rendu du graphique des abonnements
 */
function renderAbonnementsChart(labels, data) {
    const ctx = document.getElementById('abonementsChart');
    if (!ctx) return;
    
    // Détruire le graphique existant s'il y en a un
    if (abonnementsChart) {
        abonnementsChart.destroy();
    }
    
    // Créer le dégradé
    const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(58, 123, 213, 0.8)');
    gradient.addColorStop(1, 'rgba(0, 210, 255, 0.2)');
    
    abonnementsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre d\'abonnements',
                data: data,
                backgroundColor: gradient,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 5,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
}

/**
 * Rendu du graphique des revenus
 */
function renderRevenusChart(labels, data) {
    const ctx = document.getElementById('revenusChart');
    if (!ctx) return;
    
    // Détruire le graphique existant s'il y en a un
    if (revenusChart) {
        revenusChart.destroy();
    }
    
    revenusChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenus (FCFA)',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return formatMoney(value);
                        }
                    }
                }
            }
        }
    });
}

// ========================
// Utilitaires
// ========================

/**
 * Animation d'un nombre
 */
function animateValue(id, start, end, duration) {
    const obj = document.getElementById(id);
    if (!obj) return;
    
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const value = Math.floor(progress * (end - start) + start);
        obj.innerHTML = value;
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

/**
 * Formatage de l'argent
 */
function formatMoney(amount) {
    return new Intl.NumberFormat('fr-FR').format(amount);
}
