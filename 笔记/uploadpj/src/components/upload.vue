<template>
    <div >
        <el-row :gutter="20">
            <el-col :span="8" :offset="8">
                <div style="height: 300px">
                </div>
                <el-card class="box-card" v-loading="loading" element-loading-text="拼命加载中"  element-loading-spinner="el-icon-loading"  element-loading-background="rgba(0, 0, 0, 0.8)">
                    <div slot="header" class="clearfix">
                        <span>上传给你下载链接</span>
                        <el-button style="float: right; padding: 3px 0" type="text">操作按钮</el-button>
                    </div>
    <el-upload
            auto-upload
            class="upload-demo"
            drag
            :show-file-list="false"
            action="/api/upload.php"
            :on-success="successUpload"
            :on-error="failUpload"
            :before-upload="beforeupload"
            :on-change="change"
            name="fileTest"
            multiple>
        <i class="el-icon-upload"></i>
        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
        <div class="el-upload__tip" slot="tip">只能上传jpg/png文件，且不超过500kb</div>
    </el-upload>
                </el-card>
            </el-col>
        </el-row>
        <el-dialog
                title="提示"
                :visible.sync="dialogVisible"
                width="25%"
                >
            <strong><span>文件保存于</span></strong>
            <code>{{ fileurl }}</code>
            <span slot="footer" class="dialog-footer">
            </span>
        </el-dialog>

    </div>
</template>

<script>
    export default {
        //name: "upload.vue",
        data(){
            return {
                filedata: "",
                loading: false,
                dialogVisible: false,
                fileurl: '',
            }
        },
        methods: {
            successUpload(response){
                this.fileurl = response.url;
                this.dialogVisible = true;
                //console.log(file);
            },
            failUpload(){
                alert('上传失败');
            },
            beforeupload(){
                this.loading = true;

            },
            change(){
                this.loading = false
            }
        }
    }
</script>

<style scoped>
.upload-demo {
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}
</style>