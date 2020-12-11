import sublinks from './data.js'
const toggleBth = document.querySelector('.stripe-toggle-btn');
const closeBtn = document.querySelector('.close-btn');
const sidebarWrapper = document.querySelector('.sidebar-wrapper');
const sidebar = document.querySelector('.sidebar-links');
const linkBtns = [...document.querySelectorAll('.stripe-link-btn')];
//make an array of that links [...list elements]
const submenu = document.querySelector('.submenu');
const hero = document.querySelector('.container-fluid');
const nav = document.querySelector('.stripe-nav');

//hide / show sidebar
toggleBth.addEventListener('click', () => {
   sidebarWrapper.classList.add('show');
});

closeBtn.addEventListener('click', () => {
   sidebarWrapper.classList.remove('show');
});

//set sidebar
sidebar.innerHTML = sublinks.map((item) => {
    const {links,page} = item;
    //first I grab the links of the page
    return `<article>
        <h4>${page}</h4>
        <div class="sidebar-sublinks">
        ${links.map((link) => {
        return `
<a href="${link.url}">
<i class="${link.icon}"></i>${link.label}
</a>
`
    }).join('')}
</div>
</article>`
}).join('');

//menu links on the big page
linkBtns.forEach((btn) => {
    btn.addEventListener('mouseover', function (e) {
        // console.log(e.currentTarget);
        //currentTarget gives us what the eventListener was net up on
        const text = e.currentTarget.textContent;
        const tempBtn = e.currentTarget.getBoundingClientRect();
        // const tempBtn = e.currentTarget.getBoundingClientRect(); => get the coordinates
        const center = (tempBtn.left + tempBtn.right) / 2;
        const bottom = tempBtn.bottom - 3;

        //get the sublinks
        const tempPage = sublinks.find(({page}) => page === text)
        //only if the page exists i would wanna show the submenu
        if(tempBtn) {
            const {page,links} = tempPage
            submenu.classList.add('show');
            submenu.style.left = `${center}px`;
            submenu.style.top = `${bottom}px`;

            //change the col
            let columns = 'col-2';
            if (links.length === 3) {
                columns = 'col-3';
            }
            if (links.length > 3) {
                columns = 'col-4';
            }

            submenu.innerHTML = `
                <section>
                <h4>${page}</h4>
                <div class="submenu-center ${columns}">
                ${links.map((link) => {
                    return `<a href="${link.url}">
<i class="${link.icon}"></i> ${link.label}
</a>`
            }).join('')}
</div>
</section>
            `
        }
    })
});

hero.addEventListener('mouseover', function (e) {
    submenu.classList.remove('show');
})

nav.addEventListener('mouseover', function (e) {
    //if I am hovering over anything that is not a nav buttom I want to hide it
    if (!e.target.classList.contains('stripe-link-btn')) {
        submenu.classList.remove('show');
    }
})


//notifications dropdown

const drop_btns = document.querySelectorAll(".drop-btn");
const menu_wrapper = document.querySelector(".dropdown-wrapper");
const dropdown_list = document.querySelector(".dropdown-menu-bar");

const tl = new TimelineMax({ paused: true, reversed: true });
tl.to(
    menu_wrapper,
    0.5,
    {y : 0}
    )
    .fromTo(
        menu_wrapper,
        0.5,
        { display: 'none', y:10 },
        { display: 'block', y:0 },
        '-=0.1'
    )

drop_btns.forEach(function (drop_btn) {
    drop_btn.addEventListener('click', () => {
        tl.reversed() ? tl.play() : tl.reverse();
    });
})
// drop_btns.addEventListener('click', () => {
//     console.log('here');
//     tl.reversed() ? tl.play() : tl.reverse();
// });


// function dropdownUnwarp() {
//     setTimeout(function () {
//         menu_wrapper.classList.toggle('show-dropdown');
//     },1000)
// }

// drop_btn.onclick = (() => {
//    menu_wrapper.classList.toggle('show-dropdown');
// });

//CHANGE PROFILE TABS
const profile_data = document.querySelector('.profile-data');
const tab_btns = document.querySelectorAll('.tab-btn');
const profile_articles = document.querySelectorAll('.user-profile-content');

profile_data.addEventListener('click', function (e) {
    const id = e.target.dataset.id;

//    e.target - THE BUTTON I CLICKED ON

//    remove active class from all buttons
  if (id) {
      tab_btns.forEach(function (btn) {
          btn.classList.remove('active-tab');
          e.target.classList.add('active-tab');
      });
  //    hide all the articles
        profile_articles.forEach(function (article) {
            article.classList.remove('active-tab');
        })

      const element = document.getElementById(id);
        element.classList.add('active-tab');
  }

})



