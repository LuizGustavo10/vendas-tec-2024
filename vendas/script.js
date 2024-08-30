$(document).ready( function () {
    $('#tabela').DataTable();
} );

var table = new DataTable('#tabela', {
    language: {
        url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json',
    },
});

$(document).ready(function(){
    $('.data').mask('00/00/0000');
    $('.cpf').mask('000.000.000-00');
    $('.cep').mask('00.000-000');
    $('.celular').mask('(00)00000-0000');
    $('.telefone').mask('(00)0000-0000');
    $('.cnpj').mask('00.000.000/0000-00');
    
});
