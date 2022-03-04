//"use strict";

const AddCatBtn = document.getElementById("add-cat");
const CatName = document.getElementById("cat-name");
const xhttp = new XMLHttpRequest();
const TableBody = document.getElementById("tablebody");
const head = document.querySelector(".page-header");
let m = "";

const ajaxset = function () {
  xhttp.open("post", "getdata.php?", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  console.log(CatName.value);
  xhttp.send(`setcatname=${CatName.value}`);
};

const ajaxget = function () {
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      head.textContent = xhr.responseText;
      console.log(xhr.responseText);

      //console.log(JSON.parse(xhttp.response));
    }
  };
  xhr.open("GET", `getdata.php?getcatname=PHP`, true);
  //xhttp.setRequestHeader("Content-Type", "application/json");
  xhr.send();
};

AddCatBtn.addEventListener("click", () => {
  ajaxset();
  ajaxget();
});
