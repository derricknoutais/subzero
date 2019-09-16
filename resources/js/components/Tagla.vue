

<script>
export default {
    props: ['products', 'subs'],
    data(){
        return {
            selected_tag: null,
            test : ['yo', 'ya'],
            prod: [''],
            isLoading : false,
            timer: null,
            interval: null,
            iterations: 0,
            isCreating: false,

            quantite: null, 
            tags: [],
            detailsEdit: false,
            nameEdit: false,
            detailsEditField : '',
            nameEditField : ''
        }
    },
    watch : { 
        'selected_tag' : function(){
            this.$refs.quantite.focus()
        },
        'quantite' : function(){

        }
    },
    methods:{
        
        addTag(){
            var name = this.selected_tag.name
            var details;

            name = name.slice(0, name.indexOf('/'))
            details = this.selected_tag.name.slice(this.selected_tag.name.indexOf('/') + 2, this.selected_tag.name.length)

            this.selected_tag.name = name
            this.selected_tag.details = details
            for (let index = 0; index < this.quantite; index++) {
                this.tags.push(this.selected_tag)
                
            }
            this.selected_tag = null
            this.$refs.select.$el.focus()
            
        },
        removeTag(index){
            this.tags.splice(index, 1)
            this.$forceUpdate()
        },
        editName(index){
            this.tags[index].name = this.nameEditField
            this.tags[index].editingName = false;
            this.$forceUpdate()
        },
        editDetails(index){
            this.tags[index].details = this.detailsEditField
            this.tags[index].editingDetails = false;
            this.$forceUpdate()
        },
        enableEditMode(index){
            this.detailsEditField = this.tags[index].details
            this.tags[index].editingDetails = true;
            this.$forceUpdate()
        },
        enableEditNameMode(index){
            this.nameEditField = this.tags[index].name
            this.tags[index].editingName = true;
            this.$forceUpdate()
        }
    },
    created(){
        axios.get('/produits').then(response => {
            this.prod = response.data;
            // console.log(response.data);
            // this.tags.push(this.prod[2])
        }).catch(error => {
            console.log(error);
        });
        
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>