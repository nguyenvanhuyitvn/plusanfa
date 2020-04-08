<template>
	<div class="clearfix" style="padding-left: 30px;">
	    <div class="history-row" v-for="message in messages">
	        <!-- <span class="history-time">06/04/2020 15:02 CH</span> <span class="history-duration">00h00p07s</span> <span class="history-code">Cổng 1</span> -->
	        <span>{{message.message}}</span> | 
	        <span>{{message.topic}}</span>
	    </div> 
	</div> 
</template>

<script>
    export default {
       props: ['messages']
    };
</script>
