const sublinks = [
    {
        page: 'products',
        links: [
            { label: 'all products', icon: 'fa fa-credit-card', url: '/products' },
            { label: 'terminal', icon: 'fa fa-credit-card', url: 'products.html' },
            { label: 'connect', icon: 'fa fa-credit-card', url: 'products.html' },
        ],
    },
    {
        page: 'developers',
        links: [
            { label: 'plugins', icon: 'fa fa-book', url: 'products.html' },
            { label: 'libraries', icon: 'fa fa-book', url: 'products.html' },
            { label: 'plugins', icon: 'fa fa-book', url: 'products.html' },
            { label: 'billing', icon: 'fa fa-book', url: 'products.html' },
        ],
    },
    {
      page: 'company',
      links: [
          { label: 'about', icon: 'fa fa-briefcase', url: 'products.html' },
          { label: 'customers', icon: 'fa fa-briefcase', url: 'products.html' },
      ],
    },
];

export default sublinks;
