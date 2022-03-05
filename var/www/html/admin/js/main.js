"use strict";

const AddCatBtn = document.getElementById("add-cat");
const CatName = document.getElementById("cat-name");
const xhttp = new XMLHttpRequest();
const TableBody = document.getElementById("tablebody");
//const head = document.querySelector(".page-header");
const DeleteBtn = document.querySelectorAll("#del-btn");

let m = "";

const ajaxset = function () {
  if (CatName) {
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        console.log(xhttp.response);
        console.log(JSON.parse(xhttp.response));
        if (xhttp.responseText === "0") {
          alert(`Problem here : ${xhttp.responseText}`);
        } else {
          const jsonobj = JSON.parse(xhttp.response);
          console.log(jsonobj);
          let cat_id = jsonobj.cat_id;
          let cat_title = jsonobj.cat_title;
          const tr = document.createElement("tr");
          const td = document.createElement("td");
          const td_1 = document.createElement("td");
          const td_2 = document.createElement("td");
          const txtnode = document.createTextNode(cat_id);
          const txtnode_1 = document.createTextNode(cat_title);
          const btn = document.createElement("button");
          const textnodebtn = document.createTextNode("Delete");
          td.appendChild(txtnode);
          td_1.appendChild(txtnode_1);
          td_2.appendChild(btn);
          console.log(td_2);
          btn.appendChild(textnodebtn);
          btn.value = cat_id;
          btn.classList.add("btn", "btn-danger");
          btn.id = "del-btn";
          tr.appendChild(td);
          tr.appendChild(td_1);
          tr.appendChild(td_2);
          TableBody.appendChild(tr);
          addEvent();
        }
      }
    };
    xhttp.open("post", "getdata.php?", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    console.log(CatName.value);
    xhttp.send(`setcatname=${CatName.value}`);
  } else {
    //todo
  }
};

const ajaxget = function () {
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      //head.textContent = xhr.responseText;
      console.log(xhr.response);
      console.log(JSON.parse(xhr.response));
      const jsonobj = JSON.parse(xhr.response);
      console.log(jsonobj);
      let cat_id = jsonobj.cat_id;
      let cat_title = jsonobj.cat_title;
      const tr = document.createElement("tr");
      const td = document.createElement("td");
      const td_1 = document.createElement("td");
      const td_2 = document.createElement("td");
      const txtnode = document.createTextNode(cat_id);
      const txtnode_1 = document.createTextNode(cat_title);
      const btn = document.createElement("button");
      const textnodebtn = document.createTextNode("Delete");
      td.appendChild(txtnode);
      td_1.appendChild(txtnode_1);
      td_2.appendChild(btn);
      console.log(td_2);
      btn.appendChild(textnodebtn);
      btn.value = cat_id;
      btn.classList.add("btn btn-danger");
      btn.id = "del-btn";

      tr.appendChild(td);
      tr.appendChild(td_1);
      tr.appendChild(td_2);
      TableBody.appendChild(tr);

      //console.log(JSON.parse(xhttp.response));
    }
  };
  xhr.open("GET", `getdata.php?getcatname=${CatName.value}`, true);
  //xhttp.setRequestHeader("Content-Type", "application/json");
  CatName.value = "";
  xhr.send();
};

const ajaxDeleteData = function (btn) {
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText === "Succes") {
        btn.parentElement.parentElement.remove();
      } else {
        alert("Failed to Delete");
      }
    }
  };
  xhr.open("GET", `getdata.php?deleteCat=${btn.value}`, true);
  xhr.send();
};

AddCatBtn.addEventListener("click", () => {
  ajaxset();
  CatName.value = "";
});

const addEvent = function () {
  const DeleteBtn = document.querySelectorAll("#del-btn");
  for (const i of DeleteBtn) {
    (function (i) {
      i.addEventListener("click", function () {
        //console.log(i.value);
        //console.log(i.parentElement.parentElement);
        ajaxDeleteData(i);
      });
    })(i);
  }
};
addEvent();
