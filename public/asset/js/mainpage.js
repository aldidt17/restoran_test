const listItems = document.querySelectorAll(".sidebar-list li");

listItems.forEach((item) => {
    item.addEventListener("click", () => {
        let isActive = item.classList.contains("active");

        listItems.forEach((el) => {
            el.classList.remove("active");
        });

        if (isActive) item.classList.remove("active");
        else item.classList.add("active");
    });
});

const toggleSidebar = document.querySelector(".toggle-sidebar");
const logo = document.querySelector(".logo-box");
const sidebar = document.querySelector(".sidebar");

toggleSidebar.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

logo.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});


// const inputgambar = document.getElementById('pict');
// inputgambar.addEventListener('change',(e)=>{
// const file = inputgambar.files[0];
// const filename = file.name;
// console.log(file);
// if (file) {
//   previewGambar.src = URL.createObjectURL(file);
// }
// namaGambar.innerHTML = filename;
// });

// function up() {
//   //if (document.getElementById("srt").value != "") {
//       const dop = document.getElementById("id_produk").value;
//       document.getElementById("na").innerHTML = dop;
//   //}
//   alert(dop);
// }

// Dapatkan elemen-elemen yang diperlukan
// var selectElement = document.getElementById("id_produk");
// var inputElement = document.getElementById("na");

// Tangani perubahan pada elemen seleksi
// selectElement.addEventListener("change", function () {
//     // Dapatkan nilai yang dipilih
//     var selectedValue = selectElement.value;

//     // Pindahkan nilai ke elemen input
//     inputElement.value = selectedValue;
// });


// for (let i = 1; i < rows.length; i++) {
//     const row = rows[i];
//     let qty = parseInt(row.querySelector("td:nth-child(5)").textContent);

//     const inputqt = row.querySelector("input");
//     if (inputqty) {
//         qty = parseInt(inputqty.value);
//         inputqty.addEventListener("input", function () {
//             const subtotal =
//                 parseInt(row.querySelector("td:nth-child(4)").textContent) *
//                 parseInt(inputqty.value);

//             row.querySelector(".subtotal").textContent = subtotal;
//         });
//     }
//     const harga = parseInt(row.querySelector("td:nth-child(4)").textContent);
//     const subtotal=harga*qty;
//     row.querySelector(".subtotal").textContent = subtotal;
// }
