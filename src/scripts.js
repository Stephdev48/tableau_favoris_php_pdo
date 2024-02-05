function alerte(){
    alert("Catégories et domaine requis !");
}


function checkMenu(){

    let checkDom = document.getElementById('menu_dom');
    let checkCat = document.getElementById('menu_cat');
    console.log(checkDom.value);
    console.log(checkCat.value);

    if (checkDom.value==null  && checkCat.value==null){
        document.getElementById('button_filter').appendChild = "<input type='submit' name='filtre' disabled value='Filtrer' class='h-3/4 w-1/4 lg:w-1/2 m-2 text-xl font-semibold bg-blue-400 p-3 rounded-xl border-solid border-black border-2 cursor-pointer hover:bg-blue-500'>";
    }else{
        document.getElementById('button_filter').appendChild = "<input type='submit' name='filtre' value='Filtrer' class='h-3/4 w-1/4 lg:w-1/2 m-2 text-xl font-semibold bg-blue-400 p-3 rounded-xl border-solid border-black border-2 cursor-pointer hover:bg-blue-500'>";
    }

}