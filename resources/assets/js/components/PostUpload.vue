<template>
    <div class="row">
        <div class="col-sm-12 col-md-10">
            <div class="card">
                <div class="header">
                    <h4 class="title">Upload  files</h4>
                    <p class="category">24 Hours performance</p>
                </div>
                <div class="content">

                    <form-wizard @on-complete="onComplete"
                                 shape="tab"
                                 color="#9b59b6">
                        <h2 slot="title">Fill in details to post</h2>
                        <tab-content title="upload files"
                                     icon="ti-user">

                            <!--upload content-->
                            <div class="file-upload">
                                <dropzone id="myVueDropzone" url="http://www.ww.com">
                                    <!-- Optional parameters if any! -->
                                    <input type="hidden" name="token" value="">
                                </dropzone>
                            </div>

                        </tab-content>

                        <tab-content title="post details"
                                     icon="ti-settings">
                            post details
                        </tab-content>
                        <tab-content title="boost your post"
                                     icon="ti-check">
                            boost your post here
                        </tab-content>
                    </form-wizard>

                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Open
                            <i class="fa fa-circle text-danger"></i> Click
                            <i class="fa fa-circle text-warning"></i> Click Second Time
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Updated 3 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {FormWizard, TabContent} from 'vue-form-wizard';
    import Dropzone from 'vue2-dropzone';

    export default {
        components: {
            FormWizard,
            TabContent,
            Dropzone
        },

        methods: {
            onComplete: function(){
                alert('Yay. Done!');
            }
        }
    }


</script>
