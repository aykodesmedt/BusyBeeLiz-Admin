require('./style.css');
require('./assets/fonts/fonts.css');

{
  const $filterForm = document.querySelector(`.patroonFilter`),
    $results = document.querySelector(`.stofResultatenDiv`);

  const init = () => {
    // return;
    if ($filterForm) {
      $filterForm.addEventListener(`submit`, e => {
        e.preventDefault();
      });
      $filterForm.addEventListener(`click`, handleClickSubmitFilterForm);
    }
  };

  const handleLoadResults = data => {
    console.log(data.json());
    $results.innerHTML = data
      .map(result => createResultListItem(result))
      .join(``);
  };

  const createResultListItem = result => {
    return `
    <article class="stofResultaat">
    <div class="resultaat_img">
      <img src="${result['image']}" alt="" width="115" height="115">
      <div>
        <div class="resultaten__div">
          <div class="fournituur__info__div">
            <h3>${result['model']}</h3>
            <p>${result['categorie']}</p>
            <p>${result['maat']}</p>
          </div>
          <div class="fournituur__icon__div">
            <img src="./assets/img/icons/edit.png" alt="" width="18" height="18">
            <img src="./assets/img/icons/delete.png" alt="" width="14" height="18">
          </div>
        </div>
        <div class="resultaat__tag">
          <span class="tag">${result['boek']}</span>
          <span class="tag">${result['maand']}</span>
          <span class="tag">${result['jaar']}</span>
        </div>
      </div>
    </div>
  </article>`;
  };

  const handleClickSubmitFilterForm = e => {
    e.preventDefault();
    console.log(e);
    console.log('submit');
    const qs = new URLSearchParams([
      ...new FormData($filterForm).entries()
    ]).toString();
    fetch(`${$filterForm.getAttribute('action')}?${qs}`, {
      headers: new Headers({
        Accept: 'application/json'
      }),
      method: 'get'
    })
      .then(r => r.json())
      .then(data => handleLoadResults(data));

    window.history.pushState(
      {},
      '',
      `${window.location.href.split('?')[0]}?${qs}`
    );
  };

  init();
}
