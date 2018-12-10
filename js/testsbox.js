class testsBox {

  constructor(data) {
    this.data = Object.values(data.tests);
    this.activePage = 0;
    this.pagination = [];
    this.mapped = this.prepareData(this.data);
    this.pageSetup(this.mapped);
    this.selectorSetup();
    this.searchSetup();
  }

  pageSetup(data) {
    this.isMultiPage(data)
      ? this.singlePageSetup(data)
      : this.multiPageSetup(
        this.chunkArray(data, 20)
      );
  }

  singlePageSetup(data) {
    data.forEach(b => testsbox.insertAdjacentHTML("beforeend", b));
  }

  multiPageSetup(data) {

    this.paginationSetup(data);

    this.addToTestBox(this.prepareArrayForPrinting(data[this.activePage]));

  }

  paginationSetup(data) {
    this.resetPagination();

    const nextPage = this.getActivePage() + 1;
    const previousPage = this.getActivePage() - 1;

    const buttons = () => {
      if(this.getActivePage() === 0){
        return `<li id="pageNo--${nextPage}" class="page-item"><a class="page-link">Next</a></li>`;
      }else if(this.getActivePage() === this.chunkArray(this.mapped, 20).length - 1){
         return `<li id="pageNo--${previousPage}" class="page-item"><a class="page-link">Previous</a></li>`;
      }else{
        return `<li id="pageNo--${previousPage}" class="page-item"><a class="page-link">Previous</a></li><li id="pageNo--${nextPage}" class="page-item"><a class="page-link">Next</a></li>`;
      }
    }


    this.pagination.push(buttons());
    this.addContent({ id: pageList, array: this.pagination });

    Array.from(pageList.children).map(a =>
      a.addEventListener("click", () => {
        this.navigateTo(a.id.split("--")[1]);
      })
    );
  }

  paginationUpdate(data) {
    this.resetPagination();

    const nextPage = this.getActivePage() + 1;
    const previousPage = this.getActivePage() - 1;

    const buttons = () => {
      if(this.getActivePage() === 0){
        return `<li id="pageNo--${nextPage}" class="page-item"><a class="page-link">Next</a></li>`;
      }else if(this.getActivePage() === this.chunkArray(this.mapped, 20).length - 1){
         return `<li id="pageNo--${previousPage}" class="page-item"><a class="page-link">Previous</a></li>`;
      }else{
        return `<li id="pageNo--${previousPage}" class="page-item"><a class="page-link">Previous</a></li><li id="pageNo--${nextPage}" class="page-item"><a class="page-link">Next</a></li>`;
      }
    }
  

    this.pagination.push(buttons());
    this.addContent({ id: pageList, array: this.pagination });

    Array.from(pageList.children).map(a =>
      a.addEventListener("click", () => {
        this.navigateTo(a.id.split("--")[1]);
      })
    );
  }

  getActivePage(){
    return parseInt(this.activePage);
  }

  addContent({ id, array }) {
    const a = this.prepareArrayForPrinting(array);
    id.insertAdjacentHTML("beforeend", a);
  }

  prepareArrayForPrinting(a) {
    return a.join("");
  }

  chunkArray(array, chunk_size) {
    const results = [];
    const myArray = this.cloneArray(array);
    while (myArray.length) {
      results.push(myArray.splice(0, chunk_size));
    }
    return results;
  }

  prepareData(data) {
    return Object.values(data).map((a, index) => this.mapData(a, index));
  }

  mapData(data, index) {
    return `<div class="card my-2">
       <div class="card-header" id="heading${index}">
         <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse${index}" aria-expanded="false" aria-controls="collapse${index}">
               ${data.title}
             </button>
         </h5>
         <div class="d-flex row align-items-center justify-content-between">
         <h6 class="category mb-0 px-2">${data.category}</h6>
         <h6 class="mb-0 px-2"><i class="far fa-clock"></i><span style="font-weight:bold;" class="px-2">${
           data.completeTime
         }</span></h6>
         <h6 class="mb-0 px-2"><i class="fas fa-hashtag"></i><span style="font-weight:bold;" class="px-2">${
           data.questions
         }</span></h6>
         </div>
       </div>
       <div id="collapse${index}" class="collapse" aria-labelledby="heading${index}" data-parent="#accordionExample">
         <div class="card-body">
            <div class="d-flex row align-items-center justify-content-between p-2">
              <p class="mb-0 px-2"><b>Time to Complete: </b>${
                data.completeTime
              }</span></p>
              <p class="mb-0 px-2"><b>Number of Questions: </b><span class="px-2">${
                data.questions
              }</span></p>
              <p class="mb-0 px-2"><b>Language: </b>${data.us}</p>
            </div> 
            <p class="description"><b>Description: </b><br />${
              data.description
            }</p>
            </div>
         </div>
       </div>
   `;
  }

  isMultiPage(array) {
    array.length <= 20;
  }

  addToTestBox(page) {
    testsbox.insertAdjacentHTML("beforeend", page);
  }

  togglePageList(list) {
    list.map(a => a.classList.remove("activePage"));
    const active = list.filter(a => a.id === `pageNo--${this.activePage}`)[0];
    active.classList.add("activePage");
  }

  navigateTo(index) {
    debugger;
    if (index != this.activePage) {
      this.activePage = index;
      this.togglePageList(this.listObjects());
      controls.scrollIntoView();
      this.paginationUpdate(this.chunkArray(this.mapped, 20));
      testsbox.innerHTML = this.prepareArrayForPrinting(this.chunkArray(this.mapped, 20)[this.activePage]);
    }
  }

  listObjects() {
    return Array.from(pageList.children);
  }

  selectorSetup() {
    const categories_all = this.data.map(a => a.category);
    const categories = [...new Set(categories_all)];
    const selectObjects = categories.map(
      a => `<option value="${a}">${a}</option>`
    );

    selectObjects.forEach(a => category.insertAdjacentHTML("beforeend", a));

    category.addEventListener("change", e => {
      const newList = this.categoryFilter(category.value);
      this.updateList(newList);
    });
  }

  updateList(data) {
    this.resetPagination();
    this.resetResults();
    this.activePage = 0;

    this.mapped = this.prepareData(data)
    this.pageSetup(this.mapped);
  }

  resetPagination() {
    pageList.innerHTML = "";
    this.pagination = [];
  }

  resetResults() {
    testsbox.innerHTML = "";
  }

  categoryFilter(value) {
    if (value === "all") {
      return this.data;
    } else {
      return this.data.filter(a => a.category === category.value);
    }
  }

  searchSetup() {
    searchbtn.addEventListener("click", () => {
      const value = search.value;
      const searchValues = this.search(this.data, value);
      if (searchValues.length > 0) {
        this.updateList(searchValues);
      }
    });
  }

  search(data, searchValue) {
    var options = {
      keys: ["title"]
    };
    var fuse = new Fuse(data, options);
    return fuse.search(searchValue);
  }

  cloneArray(array){return array.slice(0)}
}
