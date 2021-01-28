<template>
   <div>
       <div class="container">
           <div class="row justify-content-center">
               <div class="col-md-8">
                   <div class="card">
                       <div class="card-header">Feedback</div>
                       <div v-if="errors.status">
                           <Alert-Component v-for="error in errors.data" :message="error[0]" status="error"/>
                       </div>
                       <div v-if="form.status">
                           <Alert-Component :message="success.message" status="success"/>
                       </div>

                       <div class="card-body">
                           <div class="form-group row">
                               <label for="name" class="col-md-4 col-form-label text-md-right">Ваше имя</label>
                               <div class="col-md-6">
                                   <input id="name" type="text" class="form-control" v-model="form.name" autofocus>
                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="phone" class="col-md-4 col-form-label text-md-right">Ваш телефон</label>

                               <div class="col-md-6">
                                   <input id="phone" v-mask="'#(###)-###-##-##'" type="text" class="form-control" v-model="form.phone" >

                               </div>
                           </div>

                           <div class="form-group row">
                               <label for="message" class="col-md-4 col-form-label text-md-right">Сообщение</label>

                               <div class="col-md-6">
                                   <textarea id="message" type="text" class="form-control" v-model="form.message" ></textarea>
                               </div>
                           </div>

                           <div class="form-group row mb-0">
                               <div class="col-md-8 offset-md-4">
                                   <button type="submit" class="btn btn-primary" @click="send">
                                       Отправить
                                   </button>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</template>

<script>
    import { VueMaskDirective } from 'v-mask'
    Vue.directive('mask', VueMaskDirective)
export default {
    name: "Orm",
    data(){
        return {
            form: {
                status: false,
            },
            success: {
                message: ""
            },
            errors: {
                status: false
            },
        }
    },
    methods: {
        send(){
            axios({
                url: "/api/send",
                method: "POST",
                data: this.form,
            })
                .then(res => {
                    console.log(res.data)
                    this.form.status = true;
                    this.success.message = res.data.message;
                    this.errors.status = false;
                    this.resetForm()
                })
            .catch(error => {
                console.log(error.response.data)
                this.errors.data = error.response.data.errors;
                this.errors.status = true;
            })

        },
        resetForm(){
            this.form.name  = ''
            this.form.phone  = ''
            this.form.message  = ''
        }
    }
}
</script>

<style scoped>

</style>
