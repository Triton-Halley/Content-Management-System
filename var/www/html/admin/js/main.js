"use strict";

const AddCatBtn = document.getElementById("add-cat");
const CatName = document.getElementById("cat-name");
const xhttp = new XMLHttpRequest();
const TableBody = document.getElementById("tablebody");
//const head = document.querySelector(".page-header");
const DeleteBtn = document.querySelectorAll("#del-btn");
const UpdateBtn = document.querySelectorAll("#update-btn");
const EditPopup = document.querySelector(".editPopup");
const PageWrapper = document.querySelector("#page-wrapper");
const closePopUp = document.querySelector(".close-btn-font");
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
          const td = createEl("td", document.createTextNode(cat_id));
          const td_1 = createEl("td", document.createTextNode(cat_title));
          const td_2 = createEl(
            "td",
            document.createElement("button"),
            "btn",
            "Delete",
            cat_id
          );
          const td_3 = createEl(
            "td",
            document.createElement("button"),
            "btn",
            "Update",
            cat_id
          );
          tr.appendChild(td);
          tr.appendChild(td_1);
          tr.appendChild(td_2);
          tr.appendChild(td_3);
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
      const td = createEl("td", document.createTextNode(cat_id));
      const td_1 = createEl("td", document.createTextNode(cat_title));
      const td_2 = createEl(
        "td",
        document.createElement("button"),
        "btn",
        "Delete",
        cat_id
      );
      const td_3 = createEl(
        "td",
        document.createElement("button"),
        "btn",
        "Update",
        cat_id
      );

      tr.appendChild(td);
      tr.appendChild(td_1);
      tr.appendChild(td_2);
      tr.appendChild(td_3);
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
  for (const j of UpdateBtn) {
    (function (j) {
      j.addEventListener("click", function () {
        EditPopup.classList.toggle("adddisplay");
        PageWrapper.classList.toggle(".overlay");
      });
    })(j);
  }
};
addEvent();

const createEl = function (
  ElementType,
  InsideELement,
  type = null,
  btnType = null,
  cat_id = null
) {
  const element = document.createElement(ElementType);
  element.appendChild(InsideELement);
  if (type === "btn") {
    if (btnType === "Delete") {
      const textnodebtn = document.createTextNode(btnType);
      InsideELement.appendChild(textnodebtn);
      InsideELement.value = cat_id;
      InsideELement.classList.add("btn", "btn-danger");
      InsideELement.id = "del-btn";
    } else {
      const textnodebtn = document.createTextNode(btnType);
      InsideELement.appendChild(textnodebtn);
      InsideELement.value = cat_id;
      InsideELement.classList.add("btn");
      InsideELement.id = "update-btn";
    }
  }
  return element;
};

document.addEventListener("resize", (e) => {
  alert(e);
});

closePopUp.addEventListener("click", () => {
  EditPopup.classList.add("adddisplay");
});
