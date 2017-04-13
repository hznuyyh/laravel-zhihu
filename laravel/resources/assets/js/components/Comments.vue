<template>
    <div>
        <button
                class="btn is-naked delete-button"
                style="margin-top: -36px;"
                v-text = 'text'
                @click=" showCommentsForm ">
        </button>
        <div class="modal fade" :id=dialog tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">
                            评论列表
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div v-if="comments.length > 0">
                            <div class="media" v-for="comment in comments">
                                <div class="media-left">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"></h4>
                                    {{comment.body}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="text" class="form-control" v-model="body">
                        <button type="button" class="btn btn-primary" @click="store">
                            评论
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['type','model','count','user'],
        data() {
            return {
                body:'',
                comments:[],
                newComment:{
                    user:{
                        name:'yyh'
                    },
                    body:''
                }
            }
        },
        computed:{
            dialog(){
                return 'comments-dialog-'+this.type + '-'+this.model
            },
            dialogId(){
                return '#' + this.dialog
            },
            text(){
                return this.count +'评论'
            }
        },
        methods:{
            store() {
                axios.post('/laravel-zhihu/laravel/public/api/comments', {
                    'type':this.type,'model':this.model,'body':this.body,'user':this.user
                }).then((response) => {
                    this.newComment.body = response.data.body
                    this.comments.push(this.newComment)
                    this.body = ''
                })
            },
            showCommentsForm() {
                this.getComments()
                $(this.dialogId).modal('show')
            },
            getComments() {
                axios.get('/laravel-zhihu/laravel/public/api/' + this.type + '/' +this.model + '/comments').
                then((response) => {
                    this.comments = response.data
                })
            }
        }
    }
</script>