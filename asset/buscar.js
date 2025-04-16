$(document).ready(function () {
    $("#buscarDeudor").click(function () {
        var cedula = $("#cedula").val().trim();

        if (cedula === "") {
            alert("Por favor, ingrese una cédula.");
            return;
        }

        $.ajax({
            url: "buscar_deudor.php",
            type: "POST",
            data: { cedula: cedula },
            dataType: "json",
            success: function (response) {
                if (response.error) {
                    $("#resultadoBusqueda").html("<p style='color:red;'>" + response.error + "</p>");
                } else {
                    $("#resultadoBusqueda").html(`
                        <p><strong>Cédula:</strong> ${response.cedula}</p>
                        <p><strong>Deudor:</strong> ${response.deudor}</p>
                        <p><strong>Abogado Externo:</strong> ${response.abogado}</p>
                        <p><strong>Teléfono:</strong> ${response.telefono}</p>
                        <p><strong>Correo:</strong> <a href="mailto:${response.correo}">${response.correo}</a></p>
                    `);
                }
            },
            error: function () {
                $("#resultadoBusqueda").html("<p style='color:red;'>Error en la consulta. Intente nuevamente.</p>");
            }
        });
    });
});

