function addKondisiMobil() {
    var margin = $("<div class='mb-3'></div>");
    var marginKondisi = $("<div class='mb-3'></div>");
    var marginKeterangan = $("<div class='mb-3'></div>");
    var batas = $("<hr class='border border-secondary border-2 opacity-50'>");
    var labelKondisiMobil = $("<label class='form-label' for='kondisi_mobil'>Kondisi Mobil</label>");
    var inputKondisiMobil = $(
        "<input class='form-control form-control' name='kondisi_mobil[]' type='file' accept='image/*' capture='camera' id='formFile' multiple>"
    );

    var labelKeterangan = $('<label for="keterangan[]"class="form-label">Keterangan</label>');
    var inputKeterangan = $(
        "<input type='text' class='form-control' id='keterangan' name='keterangan[]' >"
    );

    var innerBodyKondisi = marginKondisi.append(labelKondisiMobil, inputKondisiMobil);
    var innerBodyKeterangan = marginKeterangan.append(labelKeterangan, inputKeterangan);
    var outlierBody = margin.append(batas, innerBodyKondisi, innerBodyKeterangan);
    $("#form-kondisi-mobil").append(outlierBody);
}

$(document).ready(() => {

    $("#driver-iya").on("change", () => {
        var parent = $("<div class='mb-3 card w-screen p-2' id='p' style='background-color: #B4D8E8 ;color: #0a7cad;'></div>");
        var label = $("<label class='form-label' for='biaya_supir' name='biaya_supir' placeholder='Silahkan Isi Biaya Supir' id='biaya_supir'>Biaya Supir</label>");
        var input = $("<input class='form-control' name='biaya_supir'>");

        var form = parent.append(label, input);
        var formFinish = $("#driver").after(form);
    });

    $("#driver-tidak").on("change", () => {
        $("#p").remove();
    });
});