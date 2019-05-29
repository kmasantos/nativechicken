<template>
    <div class="row">
        <div class="col s12 m12 l12">
           <div class="row">
               <div class="col s12 m12 l12">
                   <div class="row">
                       <div class="col s12 m12 l12">
                            <hooper :rtl="true" :infiniteScroll="true" :autoPlay="true" :playSpeed="2000" :centerMode="true" style="height: 500px;">
                                <slide>
                                    <img src="https://vignette.wikia.nocookie.net/kpop/images/e/e5/TWICE_Dahyun_Fancy_You_promotional_photo.png/revision/latest?cb=20190515193456" alt="">
                                </slide>
                                <slide>
                                    slide 2
                                </slide>
                                <slide>
                                    slide 3
                                </slide>
                                <slide>
                                    slide 4
                                </slide>
                                <hooper-pagination slot="hooper-addons"></hooper-pagination>
                            </hooper>
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>    
</template>

<script>
import { Hooper, Slide, Pagination as HooperPagination } from 'hooper';
import 'hooper/dist/hooper.css';
export default {
    components: {
      Hooper,
      Slide,
      HooperPagination
    }
}
</script>

<style scoped>

</style>

