<?php
/*

  ____          _____               _ _           _       
 |  _ \        |  __ \             (_) |         | |      
 | |_) |_   _  | |__) |_ _ _ __ _____| |__  _   _| |_ ___ 
 |  _ <| | | | |  ___/ _` | '__|_  / | '_ \| | | | __/ _ \
 | |_) | |_| | | |  | (_| | |   / /| | |_) | |_| | ||  __/
 |____/ \__, | |_|   \__,_|_|  /___|_|_.__/ \__, |\__\___|
         __/ |                               __/ |        
        |___/                               |___/         
    
____________________________________
/ Si necesitas ayuda, contáctame en \
\ https://parzibyte.me               /
 ------------------------------------
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||
Creado por Parzibyte (https://parzibyte.me).
------------------------------------------------------------------------------------------------
Si el código es útil para ti, puedes agradecerme siguiéndome: https://parzibyte.me/blog/sigueme/
Y compartiendo mi blog con tus amigos
También tengo canal de YouTube: https://www.youtube.com/channel/UCroP4BTWjfM0CkGB6AFUoBg?sub_confirmation=1
------------------------------------------------------------------------------------------------
*/ ?>
<?php

include_once "session_check.php";
include_once "header.php";
include_once "nav.php";
include_once "vendor/autoload.php";
?>
<div class="row" id="app">
    <div class="col-12">
        <h1>Link management</h1>
        <a href="add_link.php" class="btn btn-success mb-2"><i class="fa fa-plus"></i>&nbsp;Add link</a>
        <input v-model="search" @keyup="getLinks()" placeholder="Search link by title or link" type="text" class="form-control">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Real link</th>
                        <th>Instant redirect</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="link in links">
                        <td>{{link.title}}</td>
                        <td>{{link.real_link}}</td>
                        <td>
                            <i v-if="link.instant_redirect" class="fa fa-check"></i>
                            <i v-else class="fa fa-times"></i>
                        </td>
                        <td>
                            <button title="Link statistics" @click="statistics(link)" class="btn btn-info btn-sm">
                                <i class="fa fa-chart-bar"></i>
                            </button>
                            <button title="Open in external tab" @click="open(link)" class="btn btn-primary btn-sm">
                                <i class="fa fa-external-link-alt"></i>
                            </button>
                            <button title="Copy" @click="copy(link)" class="btn btn-success btn-sm">
                                <i class="fa fa-clipboard"></i>
                            </button>
                            <button title="Edit" @click="edit(link)" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button title="Delete" @click="deleteLink(link)" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="js/vue.min.js"></script>
<script src="js/vue-toasted.min.js"></script>
<script src="js/sweetalert2.min.js"></script>
<script>
    Vue.use(Toasted);
    new Vue({
        el: "#app",
        data: () => ({
            links: [],
            search: "",
        }),
        mounted() {
            this.getLinks();
        },
        methods: {
            statistics(link) {
                window.location.href = "./link_statistics.php?id=" + link.id;
            },
            open(link) {
                window.open(this.getLinkForSharing(link));
            },
            edit(link) {
                window.location.href = "./edit_link.php?id=" + link.id;
            },
            async deleteLink(link) {
                const result = await Swal.fire({
                    title: 'Delete',
                    text: "Are you sure you want to delete this link?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#e51c23',
                    cancelButtonColor: '#4A42F3',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes, delete it'
                });
                if (result.value) {
                    window.location.href = "./delete_link.php?id=" + link.id;
                }
            },
            async copy(link) {
                const fullUrl = this.getLinkForSharing(link);
                if (!navigator.clipboard) {
                    prompt("Please press CTRL + C", fullUrl);
                } else {
                    await navigator.clipboard.writeText(fullUrl);
                }
                this.$toasted.show("Copied", {
                    position: "top-right",
                    duration: 1000,
                });
            },
            getLinkForSharing(link) {
                const url = new URL(window.location);
                let path = url.pathname.split("/");
                path.pop(); // remove the last
                url.pathname = path.join("/");
                return url.href + `/${link.hash}`;
            },
            async getLinks() {
                const r = await fetch(`./get_links_ajax.php?search=${this.search}`);
                const links = await r.json();
                this.links = links;
            }
        }
    });
</script>
<?php include_once "footer.php"; ?>