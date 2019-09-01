<template>
    <div class="tab-content">
        <div class="layout-col">
            <div class="tab-content-section">
                <h3 class="definition-list-title">{{ meta.description }}</h3>
                <dl class="definition-list">
                    <dt class="definition-label">Current Repository</dt>
                    <dd class="definition-value">
                        <a :href="repoUrl" target="_blank" class="underline">{{ repoUrl }}</a>
                    </dd>
                </dl>
                <!-- <hr>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Title">
                </div> -->
            </div>
        </div>
        <div class="tabs">
            <nav class="tab-nav">
                <ul class="tab-bar">
                    <li>
                        <button class="tab" :class="showPreview ? '' : 'tab-active'" @click="showPreview = false">
                            Edit Markdown
                        </button>
                    </li>
                    <li>
                        <button class="tab" :class="showPreview ? 'tab-active' : ''" @click="getMarkdown">
                            Preview
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="flex justify-center mb-4 mt-4">
            <button class="button-secondary" style="background: rgb(114, 224, 175)" @click="openIssue">
                Open Issue
            </button>
        </div>
        <div class="tab-main">
            <div class="tab-content" id="ignition-git-content">
                <div class="tab-pane fade editor" v-show="!showPreview" id="write" role="tabpanel"
                    aria-labelledby="write-tab">
                    <label for="">Markdown Editor</label>
                    <textarea :value="markdown"></textarea>
                </div>
                <div class="tab-pane fade" v-show="showPreview" id="preview" role="tabpanel"
                    aria-labelledby="preview-tab">
                    <label for="">Parsed Markdown</label>
                    <div class="markdown-body" v-html="compiledMarkdown"></div>
                </div>
                <hr />
            </div>
        </div>

        <flash-message :message.sync="message"></flash-message>
    </div>
</template>

<script>
    import '../../css/tailwind.css'

    import gitUrlParse from 'git-url-parse';

    let axios = require('axios');
    let FlashMessage = require('./FlashMessage');
    // move these to a separate file
    let path = '/ignition-vendor/reecem/ignition-git';

    export default {
        props: ['meta'],
        inject: ['report'],
        data() {
            return {
                markdown: '# Hello',
                compiledMarkdown: '',
                showPreview: false,
                message: null
            };
        },
        components: {
            FlashMessage,
        },
        created() {
            let $link = document.createElement('link');
            ($link.href = 'https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/3.0.1/github-markdown.min.css'),
            ($link.rel = 'stylesheet');

            document.head.appendChild($link);
        },
        mounted() {
            //
            this.getTemplate();
        },
        methods: {
            getMarkdown() {
                this.showPreview = true;

                axios.post('https://api.github.com/markdown', {
                        text: this.markdown,
                        mode: 'gfm'
                    })
                    .then(({
                        data
                    }) => {
                        this.compiledMarkdown = data;
                    })
                    .catch(error => {
                        this.message = {
                            message: error.message,
                            type: 'error'
                        }
                    });
            },

            openIssue() {
                axios.post(path + '/open-issue', {
                        title: this.report.exception_class,
                        body: this.markdown,
                        git: this.git
                    })
                    .then(response => {
                        // alert(response);
                        // console.log(response);
                        this.message = {
                            text: response.data.message,
                            type: 'success'
                        }
                    })
                    .catch(error => {
                        // console.error(error);
                        this.message = {
                            text: data.response.message || data.message,
                            type: 'error'
                        }
                    });
            },

            getTemplate() {
                axios.get(path + '/template/template').then(({
                    data
                }) => {
                    if (data) {
                        /**
                         * @todo clean this style of editing the thing up
                         */
                        data = data.replace(':title:', `Exception Occured in: ${this.report.exception_class}`);
                        data = data.replace(':exception_message:', this.report.message);
                        data = data.replace(':stacktrace:', JSON.stringify(this.report.stacktrace));
                        data = data.replace(':commit_sha:', this.git.hash);
                        data = data.replace(':hash_url:', this.commitUrl);

                        this.markdown = data;
                    }
                });
            }
        },
        computed: {
            git() {
                return this.report.context.git;
            },

            env() {
                return this.report.context.env;
            },

            context() {
                return this.report.context.context;
            },

            repoInfo() {
                return gitUrlParse(this.git.remote);
            },

            repoUrl() {
                const git = {
                    ...this.repoInfo,
                    git_suffix: false
                };

                return gitUrlParse.stringify(git, 'https');
            },

            commitUrl() {
                return `${this.repoUrl}/commit/${this.git.hash}`;
            },

            tagUrl() {
                return this.git.tag ? `${this.repoUrl}/releases/tag/${this.git.tag}` : this.repoUrl;
            },

            customContextGroups() {
                const customGroups = Object.keys(this.report.context).filter(
                    key => !predefinedContextItemGroups.includes(key)
                );

                return Object.assign({},
                    ...customGroups.map(prop => {
                        return {
                            [prop]: this.report.context[prop]
                        };
                    })
                );
            }
        }
    };

</script>

<style>
    .markdown-body {
        box-sizing: border-box;
        min-width: 200px;
        max-width: 980px;
        margin: 0 auto;
        padding: 45px;
    }

    @media (max-width: 767px) {
        .markdown-body {
            padding: 15px;
        }
    }

    textarea,
    #editor div {
        display: inline-block;
        width: 100%;
        height: 100vh;
        vertical-align: top;
        box-sizing: border-box;
        padding: 0 20px;
    }

    .editor {
        padding: 0 10rem;
    }

    textarea {
        border: none;
        border-right: 1px solid #ccc;
        resize: none;
        outline: none;
        background-color: #f6f6f6;
        font-size: 14px;
        font-family: 'Monaco', courier, monospace;
        padding: 20px;
    }

</style>
