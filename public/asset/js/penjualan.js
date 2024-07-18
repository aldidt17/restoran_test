// Event listener untuk setiap input qty
const inputqtys = document.querySelectorAll(".input-qtyy");
inputqtys.forEach((inputqtyy) => {
    inputqtyy.addEventListener("input", () => {
        const tablerow = inputqtyy.closest("tr");
        const inputharga = tablerow.querySelector(".text-ha"); // Menggunakan class yang sesuai untuk harga
        const inputsubtotal = tablerow.querySelector(".input-subtotal");
        const textsubtotal = tablerow.querySelector(".text-subtotal");
        const qty = tablerow.querySelector(".input-qtyy");

        // Menghindari input qty yang kurang dari 1
        if (inputqtyy.value < 1) {
            inputqtyy.value = 1;
        }

        // Menghitung subtotal berdasarkan harga dan qty
        inputsubtotal.value = inputharga.textContent * inputqtyy.value;
        textsubtotal.textContent = formatRupiah(inputsubtotal.value);

        // Memperbarui nilai qty yang tersembunyi
        qty.value = inputqtyy.value;

        // Memanggil fungsi hitungTotalSubtotal untuk memperbarui total keseluruhan
        hitungTotalSubtotal();
        setkembalian();
    });
});

// Fungsi untuk menghitung total subtotal di semua item
function hitungTotalSubtotal() {
    const subtotalElements = document.querySelectorAll(".input-subtotal");
    console.log(subtotalElements);
    // Ambil semua elemen subtotal
    let total = 0;

    subtotalElements.forEach((element) => {
        total += parseInt(element.value);
    });
    total = Math.floor(total);

    const inputtot = document.getElementById("totaltrans");
    const tot = document.getElementById("totaltrans2");
    inputtot.textContent = formatRupiah(total);
    inputtot.value = formatRupiah(total);
    tot.textContent = total;
    tot.value = total;
}
hitungTotalSubtotal();

function formatRupiah(number) {
    if (!number) number = 0;
    number += "";
    const rawValue = number.replace(/[^0-9]/g, "");
    const formattedValue = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    }).format(rawValue);
    return formattedValue.split(",")[0];
}

// Event listener untuk input pembayaran
const inputbayar = document.getElementById("bayar");
inputbayar.addEventListener("input", () => {
    // Menghilangkan karakter non-digit
    inputbayar.value = formatRupiah(inputbayar.value);
    inputbayar.nextElementSibling.value = inputbayar.value.replace(/[^0-9]/g, "");

    // Memanggil fungsi setkembalian untuk menghitung kembalian
    setkembalian();
});

// Fungsi untuk menghitung dan menampilkan kembalian
function setkembalian() {
    const totalHarga = document.getElementById("totaltrans2").value;
    const bayar = document.getElementById("bayar2").value.replace(/[^0-9]/g, "");

    let kembalian = bayar - totalHarga;

    if (kembalian < 0) {
        kembalian = 0;
        document.getElementById("btnsimpan").setAttribute("disabled", true);
    } else {
        document.getElementById("btnsimpan").removeAttribute("disabled");
    }

    // Menampilkan kembalian dengan format mata uang IDR
    const kembalianInput = document.getElementById("kembali");
    kembalianInput.value = formatRupiah(kembalian);
    kembalianInput.nextElementSibling.value = kembalian;
}
