
const e = React.createElement;
const category_data = [
    {
        label: 'Men',
        source: 'https://www.ifairer.com/article_image/1506761608-ifairer.jpg',
        id: 1,
        data: [
            {
                label: 'Clothing',
                id: 11,
                data: [
                    {

                        label: "Topwear",
                        id: 22,
                        data: [
                            {
                                label: 'T-Shirts',
                                tag: [1, 11, 22],
                                source: 'https://assets.myntassets.com/f_webp,dpr_1.0,q_60,w_210,c_limit,fl_progressive/assets/images/1700944/2019/6/8/972c9498-3a37-4d5d-976c-4493b4d5c0021559989322793-HRX-by-Hrithik-Roshan-Men-Yellow-Printed-Round-Neck-T-Shirt--1.jpg',
                                id: 26,
                            },
                            {
                                label: 'Casual Shirts',
                                tag: [1, 11, 22],
                                source: 'https://assets.myntassets.com/f_webp,dpr_1.0,q_60,w_210,c_limit,fl_progressive/assets/images/10456354/2019/8/22/d56e75f6-f1a7-4fdd-b430-51befb36f88d1566454760527-Campus-Sutra-Men-Colourblocked-Casual-Spread-Shirt-290156645-1.jpg',
                                id: 27,
                            }
                        ]
                    },
                    {
                        label: "Bottomwear",
                        id: 32,
                        data: [
                            {
                                label: 'Jeans',
                                tag: [1, 11, 32],
                                source: 'https://assets.myntassets.com/f_webp,dpr_1.0,q_60,w_210,c_limit,fl_progressive/assets/images/11560192/2020/10/23/f1265717-8107-41a0-84cb-6c78a170e27b1603441327874ShirtsLeeCooperMenShirtsLeeCooperMenShirtsLeeCooperMenShirts1.jpg',
                                id: 28,
                            },
                            {
                                label: 'Casual Trousers',
                                tag: [1, 11, 32],
                                source: 'https://assets.myntassets.com/f_webp,dpr_1.0,q_60,w_210,c_limit,fl_progressive/assets/images/2290043/2018/2/7/11517998932670-HIGHLANDER-Men-Khaki-Tapered-Fit-Solid-Chinos-8701517998932466-1.jpg',
                                id: 29,
                            }
                        ]
                    },
                    {
                        label: "Sports & Active wear",
                        id: 33,
                        data: [
                            {
                                label: 'Active T-Shirts',
                                tag: [1, 11, 33],
                                source: 'https://assets.myntassets.com/f_webp,dpr_1.0,q_60,w_210,c_limit,fl_progressive/assets/images/2314372/2018/6/19/29e8ddfd-6f5f-43fd-8b71-dfa8ac6cef681529385860869-HRX-by-Hrithik-Roshan-Men-Charcoal-Grey-Slim-Advanced-Rapid--1.jpg',
                                id: 30,
                            },
                            {
                                label: 'Track Pants & Shots',
                                tag: [1, 11, 33],
                                source: 'https://assets.myntassets.com/f_webp,dpr_1.0,q_60,w_210,c_limit,fl_progressive/assets/images/9436559/2019/5/24/ed27dce2-dc71-4fd5-9efd-5adc874f7c531558676240432-Maniac-Men-Black-Solid-Slim-Fit-Joggers-6111558676238911-1.jpg',
                                id: 31,
                            }
                        ]
                    },
                ]
            },
            {
                label: 'FootWear',
                id: 12,
                data: [
                    {
                        label: "Casual Shoes",
                        tag: [1, 12],
                        source: 'https://assets.myntassets.com/f_webp,dpr_1.0,q_60,w_210,c_limit,fl_progressive/assets/images/11334994/2020/5/21/3d167b8c-e00e-4a53-9f3f-b7e4e2f2a4481590080005795PumaMenBlackPacerStyxIDPSneakers1.jpg',
                        id: 23,
                    },
                    {
                        label: "Formal Shoes",
                        tag: [1, 12],
                        source: 'https://assets.myntassets.com/f_webp,dpr_1.0,q_60,w_210,c_limit,fl_progressive/assets/images/productimage/2020/8/10/d9cdffed-9592-4edd-b18b-38cd3bd8e7af1597021014092-1.jpg',
                        id: 24,
                    },
                ]
            },
            {
                label: 'Accessories',
                id: 13,
                data: []
            },
            {
                label: 'Personal Care & Grooming',
                id: 14,
                data: []
            },
            {
                label: 'Essentials',
                id: 15,
                data: []
            }
        ]
    },
    {
        label: 'Women',
        source: 'https://image.freepik.com/free-photo/outdoor-hight-fashion-portrait-stylish-casual-woman-black-hat-pink-suit-white-blouse-posing-old-street_273443-1186.jpg',
        id: 2,
        data: [
            {
                label: 'Clothing',
                id: 16,
                data: [
                    {
                        label: "Westernwear",
                        source: 'https://assets.myntassets.com/f_webp,dpr_1.0,q_60,w_210,c_limit,fl_progressive/assets/images/5829327/2018/9/6/24a5803c-8f86-456d-b534-dbc443642abc1536218261331-Roadster-Women-Sweatshirts-9281536218261057-1.jpg',
                        id: 25,
                        tag: [2, 16],
                        data: []
                    },
                    {
                        label: "Sports & Active Wear",
                        source: 'https://assets.myntassets.com/f_webp,dpr_1.0,q_60,w_210,c_limit,fl_progressive/assets/images/11528742/2020/10/22/1261315a-2071-469d-a835-a8951040315c1603344895239TrackPantsAlcisWomenJacketsADIDASWomenTightsADIDASOriginalsW1.jpg',
                        id: 26,
                        tag: [2, 16],
                        data: []
                    },

                ]
            },
            {
                label: 'FootWear',
                id: 17,
                data: []
            },
            {
                label: 'Accessories',
                id: 18,
                data: []
            },
            {
                label: 'Beauty & Personal Care',
                id: 19,
                data: []
            }
        ]
    },
    {
        label: 'Kids',
        id: 3,
        source: 'https://i.pinimg.com/originals/3b/a4/37/3ba437d9fab767bb18cae96b53046728.jpg',
        data: [
            {
                label: 'Girl',
                source: 'https://i.pinimg.com/564x/a1/c6/27/a1c627a1e88acacf1f95141a9717d667.jpg',
                tag: [3],
                id: 20,
                data: []
            },
            {
                label: 'Boy',
                source: 'https://i.pinimg.com/236x/a7/cf/26/a7cf26fc463834e4cd6599a46a46339f.jpg',
                id: 20,
                tag: [3],
                data: []
            },
            {
                label: 'Infant',
                source: 'https://i.pinimg.com/564x/7b/53/27/7b5327601ab17253c5d5ee6d90e091ef.jpg',
                id: 21,
                tag: [3],
                data: []
            }
        ]
    },
    {
        label: 'Fabrics',
        source: 'https://image.freepik.com/free-photo/outdoor-hight-fashion-portrait-stylish-casual-woman-black-hat-pink-suit-white-blouse-posing-old-street_273443-1186.jpg',
        id: 4,
        data: []
    },
    {
        label: 'Home Living',
        source: 'https://image.freepik.com/free-photo/outdoor-hight-fashion-portrait-stylish-casual-woman-black-hat-pink-suit-white-blouse-posing-old-street_273443-1186.jpg',
        id: 5,
        data: []
    },
    {
        label: 'Plus Size',
        source: 'https://image.freepik.com/free-photo/outdoor-hight-fashion-portrait-stylish-casual-woman-black-hat-pink-suit-white-blouse-posing-old-street_273443-1186.jpg',
        id: 6,
        data: []
    },
    {
        label: 'Beauty & Personal Care',
        source: 'https://image.freepik.com/free-photo/outdoor-hight-fashion-portrait-stylish-casual-woman-black-hat-pink-suit-white-blouse-posing-old-street_273443-1186.jpg',
        id: 7,
        data: []
    },
    {
        label: 'Trending Now',
        source: 'https://image.freepik.com/free-photo/outdoor-hight-fashion-portrait-stylish-casual-woman-black-hat-pink-suit-white-blouse-posing-old-street_273443-1186.jpg',
        id: 8,
        data: []
    },
    {
        label: 'Innerwear',
        source: 'https://image.freepik.com/free-photo/outdoor-hight-fashion-portrait-stylish-casual-woman-black-hat-pink-suit-white-blouse-posing-old-street_273443-1186.jpg',
        id: 9,
        data: []
    },
    {
        label: 'Accessories',
        source: 'https://image.freepik.com/free-photo/outdoor-hight-fashion-portrait-stylish-casual-woman-black-hat-pink-suit-white-blouse-posing-old-street_273443-1186.jpg',
        id: 10,
        data: []
    },
];
function CategoryComponent() {
    const { list, setList } = React.useState([]);
    React.useEffect(function () {
        let data = [
            {
                label: "categories",
                id: null,
                data: category_data.map(function ({ id, label }) {
                    return {
                        id,
                        label
                    }
                })
            }
        ];
        console.log(data);
        setList(data)
    }, [])
    const expandList = (data = []) => {
        let prepareList = []
    }
    return (
        <div className="d-flex">
            {[].map(function ({ label, id, data }, ind) {
                return (
                    <div className="block block-rounded js-ecom-div-nav d-none d-xl-block " style={{ width: '250px' }}>
                        <div className="block-header block-header-default">
                            <h3 className="block-title">
                                <i className="fa fa-fw fa-boxes text-muted mr-1"></i> {label}
                            </h3>
                        </div>
                        <div className="block-content hide-scrollbar" style={{ maxHeight: '280px', overflowY: 'scroll' }}>
                            <ul className="nav nav-pills flex-column push">
                                {data.map(function (ele, ind) {
                                    return (
                                        <li key={ind} className="nav-item mb-1 d-flex justify-content-start align-items-center">
                                            <i className="far fa-folder"></i>
                                            <a className="nav-link w-100 d-flex justify-content-between align-items-center" onClick={() => expandList(ele)}>
                                                {ele.label}
                                                <i className="fa fa-angle-right"></i>
                                            </a>
                                        </li>
                                    )
                                })
                                }
                            </ul>
                        </div>
                    </div>
                )
            })
            }
        </div>
    );
}

ReactDOM.render(
    <CategoryComponent data="{{$categories}}" />,
    document.getElementById('categoryComponent_div')
);
