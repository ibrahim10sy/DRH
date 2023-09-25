
function imprimerDetails() {
    // Masquer les éléments indésirables lors de l'impression
    document.getElementById('sidebarToggleTop').style.display = 'none';
    document.querySelector('.navbar').style.display = 'none';
    document.querySelector('.sticky-footer').style.display = 'none';
    
    // Imprimer la partie des détails
    window.print();
    
    // Rétablir la visibilité des éléments après l'impression
    document.getElementById('sidebarToggleTop').style.display = '';
    document.querySelector('.navbar').style.display = '';
    document.querySelector('.sticky-footer').style.display = '';
}

