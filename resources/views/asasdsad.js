(self.webpackChunk_N_E = self.webpackChunk_N_E || []).push([

    [974],

    {

        7735: (e, s, a) => {

            "use strict";

            a.d(s, { default: () => W });

            var t = a(8081),

                i = a(2149),

                r = a(5186),

                l = a(2950),

                o = a(9187),

                n = a(7531),

                d = a(6546),

                c = a(7474),

                m = a(3716),

                x = a(8295),

                h = a(1153);

            function u(e) {

                let { showUserButton: s = !1, userData: a = null, onLoginClick: i } = e;

                return (0, t.jsx)("header", {

                    className: "bg-white z-50 fixed w-full top-0",

                    children: (0, t.jsxs)("div", {

                        className: "container mx-auto px-4 py-4 flex items-center justify-between",

                        children: [

                            (0, t.jsx)("a", {

                                href: "/",

                                children: (0, t.jsx)("img", { src: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Gov.br_logo.svg/1200px-Gov.br_logo.svg.png", alt: "gov.br logo", className: "h-6 md:h-7" }),

                            }),

                            (0, t.jsxs)("div", {

                                className: "flex items-center space-x-4",

                                children: [

                                    !s &&

                                        i &&

                                        (0, t.jsxs)(t.Fragment, {

                                            children: [

                                                (0, t.jsxs)("button", {

                                                    className: "bg-[#1351B4] text-white rounded-full px-4 py-2 text-sm flex items-center hover:bg-[#0c326f] transition-colors",

                                                    onClick: i,

                                                    children: [(0, t.jsx)(d.A, { className: "mr-2 text-sm" }), "Entrar com gov.br"],

                                                }),

                                                (0, t.jsx)("div", { className: "w-px h-6 bg-gray-300" }),

                                            ],

                                        }),

                                    s &&

                                        (0, t.jsxs)(t.Fragment, {

                                            children: [(0, t.jsx)("button", { className: "text-blue-600", children: (0, t.jsx)(c.A, { className: "text-base" }) }), (0, t.jsx)("div", { className: "w-px h-6 bg-gray-300" })],

                                        }),

                                    (0, t.jsx)("button", { className: "text-blue-600", children: (0, t.jsx)(m.A, { className: "text-base" }) }),

                                    (0, t.jsx)("button", { className: "text-blue-600", children: (0, t.jsx)(x.A, { className: "text-base" }) }),

                                    s &&

                                        (0, t.jsxs)(t.Fragment, {

                                            children: [

                                                (0, t.jsx)("button", { className: "text-blue-600", children: (0, t.jsx)(h.A, { className: "text-base" }) }),

                                                (0, t.jsxs)("button", {

                                                    className: "bg-blue-600 text-white rounded-full px-4 py-2 text-sm flex items-center",

                                                    children: [(0, t.jsx)(d.A, { className: "mr-2 text-sm" }), (null == a ? void 0 : a.nome) ? a.nome.split(" ")[0].toUpperCase() : "USU\xc1RIO"],

                                                }),

                                            ],

                                        }),

                                ],

                            }),

                        ],

                    }),

                });

            }

            var g = a(6525);

            function p() {

                return (0, t.jsxs)("nav", {

                    className: "bg-white px-6 py-4 flex justify-between items-center mt-16",

                    children: [

                        (0, t.jsxs)("button", {

                            className: "border-none text-blue-600 flex items-center cursor-pointer",

                            children: [(0, t.jsx)(h.A, { className: "mr-3 text-lg" }), (0, t.jsx)("span", { className: "text-gray-600 text-sm font-light", children: "Servi\xe7os e Informa\xe7\xf5es do Brasil" })],

                        }),

                        (0, t.jsxs)("div", {

                            className: "flex items-center gap-5",

                            children: [

                                (0, t.jsx)("div", { className: "flex items-center text-blue-600", children: (0, t.jsx)(g.A, { className: "text-xl" }) }),

                                (0, t.jsx)("div", { className: "flex items-center text-blue-600", children: (0, t.jsx)(l.A, { className: "text-xl" }) }),

                            ],

                        }),

                    ],

                });

            }

            var b = a(392);

            function j() {

                return (0, t.jsxs)("footer", {

                    children: [

                        (0, t.jsx)("div", {

                            className: "bg-gray-800 text-white py-6",

                            children: (0, t.jsxs)("div", {

                                className: "container mx-auto px-4",

                                children: [

                                    (0, t.jsx)("div", {

                                        className: "py-3",

                                        children: (0, t.jsx)("img", {

                                            src: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Gov.br_logo.svg/1200px-Gov.br_logo.svg.png",

                                            alt: "Government of Brazil logo showing gov.br in white text",

                                            className: "w-24",

                                        }),

                                    }),

                                    (0, t.jsx)("div", { className: "border-t border-gray-600" }),

                                    (0, t.jsx)("nav", {

                                        children: (0, t.jsxs)("ul", {

                                            className: "text-sm",

                                            children: [

                                                (0, t.jsx)("li", { className: "py-3", children: (0, t.jsx)("a", { href: "#", className: "text-sm hover:underline", children: "SOBRE O MINIST\xc9RIO" }) }),

                                                (0, t.jsxs)("li", {

                                                    className: "border-t border-gray-600 py-3 flex justify-between items-center",

                                                    children: [(0, t.jsx)("a", { href: "#", className: "text-sm hover:underline", children: "SERVI\xc7OS DO PROGRAMA" }), (0, t.jsx)(b.A, { className: "text-xs" })],

                                                }),

                                                (0, t.jsxs)("li", {

                                                    className: "border-t border-gray-600 py-3 flex justify-between items-center",

                                                    children: [(0, t.jsx)("a", { href: "#", className: "text-sm hover:underline", children: "NAVEGA\xc7\xc3O POR P\xdaBLICO" }), (0, t.jsx)(b.A, { className: "text-xs" })],

                                                }),

                                                (0, t.jsxs)("li", {

                                                    className: "border-t border-gray-600 py-3 flex justify-between items-center",

                                                    children: [(0, t.jsx)("a", { href: "#", className: "text-sm hover:underline", children: "ACESSIBILIDADE" }), (0, t.jsx)(b.A, { className: "text-xs" })],

                                                }),

                                                (0, t.jsxs)("li", {

                                                    className: "border-t border-gray-600 py-3 flex justify-between items-center",

                                                    children: [(0, t.jsx)("a", { href: "#", className: "text-sm hover:underline", children: "ACESSO \xc0 INFORMA\xc7\xc3O" }), (0, t.jsx)(b.A, { className: "text-xs" })],

                                                }),

                                                (0, t.jsxs)("li", {

                                                    className: "border-t border-gray-600 py-3 flex justify-between items-center",

                                                    children: [(0, t.jsx)("a", { href: "#", className: "text-sm hover:underline", children: "CENTRAIS DE CONTE\xdaDO" }), (0, t.jsx)(b.A, { className: "text-xs" })],

                                                }),

                                                (0, t.jsxs)("li", {

                                                    className: "border-t border-gray-600 py-3 flex justify-between items-center",

                                                    children: [(0, t.jsx)("a", { href: "#", className: "text-sm hover:underline", children: "CANAIS DE ATENDIMENTO" }), (0, t.jsx)(b.A, { className: "text-xs" })],

                                                }),

                                                (0, t.jsxs)("li", {

                                                    className: "border-t border-gray-600 py-3 flex justify-between items-center",

                                                    children: [(0, t.jsx)("a", { href: "#", className: "text-sm hover:underline", children: "PROGRAMAS E PROJETOS" }), (0, t.jsx)(b.A, { className: "text-xs" })],

                                                }),

                                            ],

                                        }),

                                    }),

                                    (0, t.jsxs)("div", {

                                        className: "mt-4 flex items-center",

                                        children: [(0, t.jsx)(m.A, { className: "text-base mr-2" }), (0, t.jsx)("span", { className: "text-sm hover:underline cursor-pointer", children: "Redefinir Cookies" })],

                                    }),

                                    (0, t.jsxs)("div", {

                                        className: "mt-6",

                                        children: [

                                            (0, t.jsxs)("div", {

                                                className: "mb-3",

                                                children: [

                                                    (0, t.jsx)("div", { className: "text-sm font-bold mb-3", children: "Redes sociais" }),

                                                    (0, t.jsxs)("ul", {

                                                        className: "flex space-x-2",

                                                        children: [

                                                            (0, t.jsx)("li", {

                                                                children: (0, t.jsx)("a", {

                                                                    href: "https://x.com/mintrabalhobr",

                                                                    "aria-label": "X",

                                                                    className: "flex items-center justify-center w-8 h-8 bg-opacity-20 bg-white rounded-full",

                                                                    children: (0, t.jsx)("svg", {

                                                                        className: "w-4 h-4",

                                                                        fill: "currentColor",

                                                                        viewBox: "0 0 24 24",

                                                                        children: (0, t.jsx)("path", {

                                                                            d: "M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z",

                                                                        }),

                                                                    }),

                                                                }),

                                                            }),

                                                            (0, t.jsx)("li", {

                                                                children: (0, t.jsx)("a", {

                                                                    href: "https://www.facebook.com/trabalhoeemprego/",

                                                                    "aria-label": "Facebook",

                                                                    className: "flex items-center justify-center w-8 h-8 bg-opacity-20 bg-white rounded-full",

                                                                    children: (0, t.jsx)("svg", {

                                                                        className: "w-4 h-4",

                                                                        fill: "currentColor",

                                                                        viewBox: "0 0 24 24",

                                                                        children: (0, t.jsx)("path", {

                                                                            d:

                                                                                "M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z",

                                                                        }),

                                                                    }),

                                                                }),

                                                            }),

                                                            (0, t.jsx)("li", {

                                                                children: (0, t.jsx)("a", {

                                                                    href: "https://www.youtube.com/c/canaltrabalho",

                                                                    "aria-label": "YouTube",

                                                                    className: "flex items-center justify-center w-8 h-8 bg-opacity-20 bg-white rounded-full",

                                                                    children: (0, t.jsx)("svg", {

                                                                        className: "w-4 h-4",

                                                                        fill: "currentColor",

                                                                        viewBox: "0 0 24 24",

                                                                        children: (0, t.jsx)("path", {

                                                                            d:

                                                                                "M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z",

                                                                        }),

                                                                    }),

                                                                }),

                                                            }),

                                                            (0, t.jsx)("li", {

                                                                children: (0, t.jsx)("a", {

                                                                    href: "https://br.linkedin.com/company/minist-rio-do-trabalho-e-emprego",

                                                                    "aria-label": "LinkedIn",

                                                                    className: "flex items-center justify-center w-8 h-8 bg-opacity-20 bg-white rounded-full",

                                                                    children: (0, t.jsx)("svg", {

                                                                        className: "w-4 h-4",

                                                                        fill: "currentColor",

                                                                        viewBox: "0 0 24 24",

                                                                        children: (0, t.jsx)("path", {

                                                                            d:

                                                                                "M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z",

                                                                        }),

                                                                    }),

                                                                }),

                                                            }),

                                                        ],

                                                    }),

                                                ],

                                            }),

                                            (0, t.jsx)("div", {

                                                className: "mt-4",

                                                children: (0, t.jsx)("a", {

                                                    href: "https://www.gov.br/acessoainformacao/pt-br",

                                                    title: "Acesse o portal sobre o acesso \xe0 informa\xe7\xe3o",

                                                    children: (0, t.jsxs)("div", {

                                                        className: "flex items-center",

                                                        children: [

                                                            (0, t.jsx)("div", {

                                                                className: "bg-blue-600 rounded-full w-10 h-10 flex items-center justify-center mr-2",

                                                                children: (0, t.jsx)("svg", {

                                                                    className: "w-5 h-5 text-white",

                                                                    fill: "currentColor",

                                                                    viewBox: "0 0 24 24",

                                                                    children: (0, t.jsx)("path", { d: "M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" }),

                                                                }),

                                                            }),

                                                            (0, t.jsxs)("div", { className: "text-white text-xs font-bold leading-tight", children: ["ACESSO \xc0", (0, t.jsx)("br", {}), "INFORMA\xc7\xc3O"] }),

                                                        ],

                                                    }),

                                                }),

                                            }),

                                        ],

                                    }),

                                ],

                            }),

                        }),

                        (0, t.jsx)("div", {

                            className: "bg-gray-900 py-3",

                            children: (0, t.jsx)("div", {

                                className: "container mx-auto px-4",

                                children: (0, t.jsxs)("div", {

                                    className: "text-xs text-white",

                                    children: [

                                        "Todo o conte\xfado deste site est\xe1 publicado sob a licen\xe7a",

                                        " ",

                                        (0, t.jsx)("a", {

                                            rel: "license",

                                            href: "https://creativecommons.org/licenses/by-nd/3.0/deed.pt_BR",

                                            className: "text-blue-400 hover:text-blue-300",

                                            children: "Creative Commons Atribui\xe7\xe3o-SemDeriva\xe7\xf5es 3.0 N\xe3o Adaptada",

                                        }),

                                        ".",

                                    ],

                                }),

                            }),

                        }),

                    ],

                });

            }

            function f() {

                return (0, t.jsxs)("div", {

                    className: "fixed inset-0 z-50 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 flex items-center justify-center",

                    children: [

                        (0, t.jsxs)("div", {

                            className: "absolute inset-0 overflow-hidden",

                            children: [

                                (0, t.jsx)("div", { className: "absolute -top-1/2 -left-1/2 w-full h-full bg-gradient-to-r from-blue-400/20 to-transparent rounded-full animate-spin", style: { animationDuration: "20s" } }),

                                (0, t.jsx)("div", {

                                    className: "absolute -bottom-1/2 -right-1/2 w-full h-full bg-gradient-to-l from-green-400/20 to-transparent rounded-full animate-spin",

                                    style: { animationDuration: "25s", animationDirection: "reverse" },

                                }),

                            ],

                        }),

                        (0, t.jsxs)("div", {

                            className: "relative z-10 text-center max-w-lg mx-auto px-8",

                            children: [

                                (0, t.jsx)("div", {

                                    className: "mb-8",

                                    children: (0, t.jsx)("img", {

                                        src: "https://www.detran.se.gov.br/portal/img/marca_cnh_social.png",

                                        alt: "CNH Social",

                                        className: "w-32 h-32 mx-auto filter drop-shadow-2xl animate-pulse rounded-lg",

                                    }),

                                }),

                                (0, t.jsx)("h1", { className: "text-3xl font-bold text-white mb-2", children: "CNH Social 2025" }),

                                (0, t.jsx)("p", { className: "text-blue-200 mb-8 text-lg", children: "Conectando brasileiros \xe0 mobilidade e autonomia" }),

                                (0, t.jsx)("div", {

                                    className: "relative mb-8",

                                    children: (0, t.jsxs)("div", {

                                        className: "w-32 h-32 mx-auto relative",

                                        children: [

                                            (0, t.jsx)("div", { className: "absolute inset-0 rounded-full border-4 border-blue-300/30" }),

                                            (0, t.jsx)("div", { className: "absolute inset-0 rounded-full border-4 border-transparent border-t-white border-r-white animate-spin" }),

                                            (0, t.jsx)("div", { className: "absolute inset-4 rounded-full border-2 border-blue-200/50" }),

                                            (0, t.jsx)("div", { className: "absolute inset-1/2 w-4 h-4 -ml-2 -mt-2 bg-white rounded-full animate-pulse" }),

                                            (0, t.jsxs)("div", {

                                                className: "absolute inset-0",

                                                children: [

                                                    (0, t.jsx)("div", { className: "absolute top-0 left-1/2 w-2 h-2 -ml-1 bg-green-400 rounded-full animate-ping", style: { animationDelay: "0s" } }),

                                                    (0, t.jsx)("div", { className: "absolute bottom-0 left-1/2 w-2 h-2 -ml-1 bg-yellow-400 rounded-full animate-ping", style: { animationDelay: "0.5s" } }),

                                                    (0, t.jsx)("div", { className: "absolute left-0 top-1/2 w-2 h-2 -mt-1 bg-red-400 rounded-full animate-ping", style: { animationDelay: "1s" } }),

                                                    (0, t.jsx)("div", { className: "absolute right-0 top-1/2 w-2 h-2 -mt-1 bg-purple-400 rounded-full animate-ping", style: { animationDelay: "1.5s" } }),

                                                ],

                                            }),

                                        ],

                                    }),

                                }),

                                (0, t.jsxs)("div", {

                                    className: "space-y-4",

                                    children: [

                                        (0, t.jsx)("div", {

                                            className: "w-full bg-blue-800/50 rounded-full h-2 mb-6",

                                            children: (0, t.jsx)("div", { className: "bg-gradient-to-r from-green-400 to-blue-400 h-2 rounded-full transition-all duration-1000 ease-out", style: { width: "40%" } }),

                                        }),

                                        (0, t.jsx)("div", {

                                            className: "min-h-[60px] flex items-center justify-center",

                                            children: (0, t.jsx)("p", { className: "text-xl text-white font-medium animate-pulse", children: "Analisando sua localiza\xe7\xe3o e perfil socioecon\xf4mico..." }),

                                        }),

                                        (0, t.jsxs)("div", {

                                            className: "flex justify-center space-x-3 mt-6",

                                            children: [

                                                (0, t.jsx)("div", { className: "w-3 h-3 rounded-full transition-all duration-500 bg-green-400 scale-110" }),

                                                (0, t.jsx)("div", { className: "w-3 h-3 rounded-full transition-all duration-500 bg-green-400 scale-110" }),

                                                (0, t.jsx)("div", { className: "w-3 h-3 rounded-full transition-all duration-500 bg-blue-300 animate-pulse" }),

                                                (0, t.jsx)("div", { className: "w-3 h-3 rounded-full transition-all duration-500 bg-blue-600/50" }),

                                                (0, t.jsx)("div", { className: "w-3 h-3 rounded-full transition-all duration-500 bg-blue-600/50" }),

                                            ],

                                        }),

                                        (0, t.jsxs)("div", {

                                            className: "grid grid-cols-3 gap-4 mt-8 text-center",

                                            children: [

                                                (0, t.jsxs)("div", {

                                                    className: "bg-white/10 backdrop-blur-sm rounded-lg p-3",

                                                    children: [

                                                        (0, t.jsx)("div", { className: "text-2xl font-bold text-white animate-pulse", children: "150 mil+" }),

                                                        (0, t.jsx)("div", { className: "text-blue-200 text-sm", children: "CNH Dispon\xedveis" }),

                                                    ],

                                                }),

                                                (0, t.jsxs)("div", {

                                                    className: "bg-white/10 backdrop-blur-sm rounded-lg p-3",

                                                    children: [

                                                        (0, t.jsx)("div", { className: "text-2xl font-bold text-white animate-pulse", children: "5.570" }),

                                                        (0, t.jsx)("div", { className: "text-blue-200 text-sm", children: "Munic\xedpios" }),

                                                    ],

                                                }),

                                                (0, t.jsxs)("div", {

                                                    className: "bg-white/10 backdrop-blur-sm rounded-lg p-3",

                                                    children: [(0, t.jsx)("div", { className: "text-2xl font-bold text-white animate-pulse", children: "27" }), (0, t.jsx)("div", { className: "text-blue-200 text-sm", children: "Estados" })],

                                                }),

                                            ],

                                        }),

                                    ],

                                }),

                            ],

                        }),

                    ],

                });

            }

            var N = a(8381),

                v = a(6079),

                y = a(2739);

            function w(e) {

                let { onAdvance: s, onImageClick: a, selectedImages: i } = e;

                return (0, t.jsx)("div", {

                    className: "min-h-screen bg-gray-100 flex items-center justify-center p-4",

                    children: (0, t.jsxs)("div", {

                        className: "bg-white rounded-lg shadow-xl max-w-sm w-full mx-4 overflow-hidden",

                        children: [

                            (0, t.jsx)("div", {

                                className: "bg-teal-600 text-white p-4",

                                children: (0, t.jsx)("div", {

                                    className: "flex justify-between items-start",

                                    children: (0, t.jsxs)("div", {

                                        className: "flex items-start space-x-3 flex-shrink-0 flex-1",

                                        children: [

                                            (0, t.jsxs)("div", {

                                                children: [

                                                    (0, t.jsxs)("h3", {

                                                        className: "text-sm font-medium leading-tight",

                                                        children: ["Clique nas imag