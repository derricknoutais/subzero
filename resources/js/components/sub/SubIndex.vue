<template>
    <div class=''>
        <div class="row">
            <div class="col-12">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action " v-for="sub in subzeros"><span>{{ sub[0].nom }}</span> <span class="badge badge-success badge-lg float-right">{{ sub[0].total }}</span></a>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    props: ['subs'],
    data(){
        return {
            subzeros: {}
        }
    },
    methods:{

    },
    created(){
        
        this.subzeros = this.subs
        var subs = (Object.values(this.subzeros));

        
        subs.forEach( sub => {
            var total = 0;
            sub.forEach( element => {
                total += element.quantité
            })
            sub[0]['total'] = total
            console.log('Le Total est: ' +total)
        });
        this.subzeros = subs
    }
}
</script>