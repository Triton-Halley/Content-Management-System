"use strict";

const AddCatBtn = document.getElementById("add-cat");
const CatName = document.getElementById("cat-name");
const xhttp = new XMLHttpRequest();
const TableBody = document.getElementById("tablebody");
const DeleteBtn = document.querySelectorAll("#del-btn");
const UpdateBtn = document.querySelectorAll("#update-btn");
const EditPopup = document.querySelector(".editPopup");
const PageWrapper = document.querySelector("#overlay");
const closePopUp = document.querySelector(".close-btn-font"); 
const CategoryEditBtn = document.getElementById("catEdit");
const UpdateInput = document.getElementById('categoryName');

//CatID
let CategoryID = 0;
let currentCategory = "";

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
          
          const td_1 = createEl("td", document.createTextNode(cat_title),'CatTitle');
          const td_2 = createEl(
            "td",
            document.createElement("button"),
            null,
            "btn",
            "Delete",
            cat_id
          );
          const td_3 = createEl(
            "td",
            document.createElement("button"),
            null,
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
        alert(xhr.responseText);
      }
    }
  };
  xhr.open("GET", `getdata.php?deleteCat=${btn.value}`, true);
  xhr.send();
};
const ajaxUpdate = function(){
const xhr = new XMLHttpRequest();
xhr.onreadystatechange = function(){
  if(xhr.readyState == 4 && xhr.status == 200){
    if(xhr.responseText == "true"){
      const tr = CategoryID.parentElement.parentElement ;
      const catTitleSelector = document.getElementById('cat-title');
      for(const item of tr.childNodes){

        if(item.innerText === catTitleSelector.innerText){
          item.innerText = UpdateInput.value ;
        }
      }
      closeEditeMode();
      UpdateInput.value ='';

    }
  }

};
xhr.open("post","getdata.php?",true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.send(`Catname=${UpdateInput.value}&CatId=${CategoryID.value}`)




}
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
  const UpdateBtn = document.querySelectorAll("#update-btn");
  for (const j of UpdateBtn) {
    (function (j) {
      j.addEventListener("click", function () {
        EditPopup.classList.toggle("adddisplay");
        PageWrapper.classList.toggle("overlay");
        CategoryID = j;
      });
    })(j);
  }
};
addEvent();

const createEl = function (
  ElementType,
  InsideELement,
  //is cat id or cat title
  catType=null,
  type = null,
  btnType = null,
  cat_id = null
) {
  const element = document.createElement(ElementType);
  element.appendChild(InsideELement);
  if(catType !== null && catType === "CatTitle"){
    element.id = 'cat-title';
  }

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
  closeEditeMode();
});

CategoryEditBtn.addEventListener('click',()=>{
  ajaxUpdate();
});

const closeEditeMode = function(){
  EditPopup.classList.add("adddisplay");
  PageWrapper.classList.toggle("overlay");
}