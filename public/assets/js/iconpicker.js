'use strict';

$('#iconpicker').iconpicker({
    align: 'center',
    arrowClass: 'btn-primary',
    arrowPrevIconClass: 'fas fa-angle-left',
    arrowNextIconClass: 'fas fa-angle-right',
    cols: 5,
    footer: true,
    header: true,
    iconset: 'fontawesome5',
    labelHeader: '{0} of {1} pages',
    labelFooter: '{0} - {1} of {2} icons',
    placement: 'bottom',
    rows: 5,
    search: true,
    searchText: 'Rechercher...',
    selectedClass: 'btn-success',
    unselectedClass: ''
});

$('#iconpicker').on('change', function(e){
    $('input[name="account[icon]"]').val(e.icon);
})