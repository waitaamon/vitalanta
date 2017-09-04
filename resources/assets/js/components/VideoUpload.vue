<template>

            <div class="row">
                <div class="col-md-10 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">Post Uploads</div>


                        <div class="panel-body">

                            <div class="upload-files" >

                                <dropzone id="myVueDropzone" url="http://www.ww.com">
                                    <!-- Optional parameters if any! -->
                                    <input type="hidden" name="token" value="">
                                </dropzone>

                                <hr>

                                <h4>Video upload</h4>

                                <input type="file" name="video" id="video" @change="fileInputChange" class="inputfile" title="choose a video file" >
                                <label for="video">Choose a video file</label>

                                <hr>
                            </div>




                            <div class="alert alert-danger" v-if="failed">Something went wrong please try again</div>

                            <div id="video-form" >

                                <div class="alert alert-info" v-if="!uploadingComplete && uploading">Your Video will be available at
                                    <a href="" target="_blank"> {{ $root.url }}/videos/{{ uid }} </a></div>
                                <div class="alert alert-success" v-if="uploadingComplete">

                                    Upload complete. Video now processing.
                                    <a href="/posts">Go to your Videos</a>
                                </div>

                                <div class="progress" v-if="!uploadingComplete && uploading">
                                    <div class="progress-bar" :style="{width: fileProgress + '%' }" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" v-model="title" id="title">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea v-model="description" class="form-control" id="description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="visibility ">Visibility</label>
                                    <select  class="form-control"  v-model="visibility">
                                        <option value="private">Private</option>
                                        <option value="unlisted">Unlisted</option>
                                        <option value="public">Public</option>
                                    </select>
                                </div>
                                <span class="help-block pull-right">{{ saveStatus }}</span>
                                <button class="btn btn-default" @click.prevent="update">Save Changes</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

</template>

<script>
    import Dropzone from 'vue2-dropzone';
    export default {
        data() {
            return {

                uid: null,
                uploading: false,
                uploadingComplete: false,
                failed: false,
                title: 'untitled',
                description: null,
                visibility: 'private',
                saveStatus: null,
                fileProgress: 0,
                fileUploadFormData: new FormData()

            }
        },
        components: {
            Dropzone
        },
        methods: {
            fileInputChange() {
                this.uploading = true;
                this.failed  = false;

                this.file = document.getElementById('video').files[0];


                //store metadata

                this.store().then(() => {



                    this.fileUploadFormData.append('video', this.file);
                    this.fileUploadFormData.append('uid', this.uid);



                    this.$http.post('/upload',  this.fileUploadFormData, {
                       progress: (e) => {
                           if(e.lengthComputable){

                               this.updateProgress(e)
                           }
                       }
                    }).then(() => {

                        this.uploadingComplete = true;

                    }, () => {

                        this.failed = true

                    });

                }, () => {

                    this.failed = true

                });

            },
            store(){
                return this.$http.post('/videos', {
                    title: this.title,
                    description: this.description,
                    visibility: this.visibility,
                    extension: this.file.name.split('.').pop()

                }).then((response) => {


                  this.uid = response.body.data.uid;


                }, response => {
                    //error callback

                });
            },

            update(){
                this.saveStatus = 'saving changes';

                return this.$http.put('/videos/' + this.uid, {
                    title: this.title,
                    description: this.description,
                    visibility: this.visibility

                }).then(response =>{

                    this.saveStatus = 'changes saved';

                    setTimeout(()=> {
                        this.saveStatus = null;
                    }, 3000)


                }, () => {
                    //error call back
                    this.saveStatus = 'Failed to save changes!';
                        console.log(response);
                });
            },

            updateProgress (e) {
                e.percent = (e.loaded / e.total) * 100;

                this.fileProgress = e.percent;
            },
        },
        mounted(){
            window.onbeforeunload = () => {
                if(this.uploading && !this.uploadingComplete && !this.failed){
                    return 'Are you sure you want to navigate away?';
                }
            }
        }
    }
</script>
