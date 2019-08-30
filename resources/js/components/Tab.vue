<template>
    <div class="tab-content">
        <div class="layout-col">
            <div class="tab-content-section">
                <h3 class="definition-list-title">{{ meta.title }}</h3>
            </div>
        </div>

        {{ report.context.git.remote }}
    </div>
</template>

<script>
    export default {
        props: ['meta'],
        inject: ['report'],
        mounted() {
            //
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
                    git_suffix: false,
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
                    key => !predefinedContextItemGroups.includes(key),
                );

                return Object.assign(
                    {},
                    ...customGroups.map(prop => {
                        return {
                            [prop]: this.report.context[prop],
                        };
                    }),
                );
            },
        },
    }
</script>

<style>

</style>
