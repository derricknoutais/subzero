

<script>
export default {
    props: ['products', 'subs'],
    data(){
        return {
            dummyInput: null,
            selected_sub: null,
            test : ['yo', 'ya'],
            prod: [''],
            isLoading : false,
            timer: null,
            interval: null,
            mySubs: {},
            iterations: 0,
            isCreating: false
        }
    },
    watch : {
        dummyInput(){
            this.query(this.dummyInput)
        }   
    },
    methods:{
        addValue(){
            this.query(this.dummyInput)
        },
        query(quer){
            this.isLoading = true;
            clearTimeout(this.timer)
            this.timer = setTimeout(() => {
                axios.get('/api/produits/' + quer).then(response => {
                    console.log(response.data);
                    if(response.data.length > 0){
                        console.log('Ready')
                        this.prod = response.data
                        this.isLoading= false
                        this.$forceUpdate()
                    }
                }).catch(error => {
                    console.log(error);
                });
            }, 1000);
        },
        alertSucces(){
            this.iterations ++
            if(this.iterations > this.selected_sub.length){
                clearInterval(this.interval)
                this.iterations = 0
            } else {
                this.$alertify.success('Le Sub a été créé avec succès');
            }
        },
        addSub(){
            this.isCreating = true;
            axios.post('/sub/store', this.selected_sub).then(response => {

                this.interval = setInterval(this.alertSucces, 3000/this.selected_sub.length);

                setTimeout(() => {
                    this.isCreating = false;
                    window.location.reload()

                }, 6000);
                
            }).catch(error => {
                console.log(error);
            });
        }
    },
    created(){
        this.mySubs = this.subs
        
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>