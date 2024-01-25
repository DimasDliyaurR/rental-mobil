function addKondisiMobil() {
    var margin = $("<div class='mb-3'></div>");
    var marginKondisi = $("<div class='mb-3'></div>");
    var marginKeterangan = $("<div class='mb-3'></div>");
    var batas = $("<hr class='border border-secondary border-2 opacity-50'>");
    var labelKondisiMobil = $("<label class='form-label' for='kondisi_mobil'>Kondisi Mobil</label>");
    var inputKondisiMobil = $(
        "<input class='form-control form-control' name='kondisi_mobil[]' type='file' id='formFile' multiple>"
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
    $("#p").hide();

    $("#driver-iya").on("change", () => {
        $("#p").show(500);
    });

    $("#driver-tidak").on("change", () => {
        $("#p").hide(500);


    });
});