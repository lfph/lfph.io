<div v-if="viewsActive.pageScreen == 'selectFeed'" class="ctf-fb-fs">
	<div class="ctf-fb-create-ctn ctf-fb-wrapper">
		<div class="ctf-fb-heading">
			<h1>{{selectFeedTypeScreen.mainHeading}}</h1>
			<div class="ctf-fb-btn ctf-fb-slctf-nxt ctf-fb-btn-ac ctf-btn-orange" :data-active="creationProcessCheckAction()" @click.prevent.default="creationProcessNext()">
				<span>{{genericText.next}}</span>
				<svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1.3332 0.00683594L0.158203 1.18184L3.97487 5.00684L0.158203 8.83184L1.3332 10.0068L6.3332 5.00684L1.3332 0.00683594Z" fill="white"/>
				</svg>
			</div>
		</div>
		<?php
		include_once CTF_BUILDER_DIR . 'templates/sections/feeds-type.php';
		include_once CTF_BUILDER_DIR . 'templates/sections/select-source.php';
   		include_once CTF_BUILDER_DIR . 'templates/sections/select-template.php';
		?>
	</div>
	<div class="ctf-fb-ft-action ctf-fb-slctfd-action ctf-fb-fs">
		<div class="ctf-fb-wrapper">
			<div class="ctf-fb-slctf-back ctf-fb-hd-btn ctf-btn-grey" @click.prevent.default="creationProcessBack()"><svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6.3415 1.18184L5.1665 0.00683594L0.166504 5.00684L5.1665 10.0068L6.3415 8.83184L2.52484 5.00684L6.3415 1.18184Z" fill="#141B38"/>
			</svg>
			<span>{{genericText.back}}</span>
		</div>
		<div class="ctf-fb-btn ctf-fb-slctf-nxt ctf-fb-btn-ac ctf-btn-orange" :data-active="creationProcessCheckAction()" @click.prevent.default="creationProcessNext()">
			<span>{{genericText.next}}</span>
			<svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1.3332 0.00683594L0.158203 1.18184L3.97487 5.00684L0.158203 8.83184L1.3332 10.0068L6.3332 5.00684L1.3332 0.00683594Z" fill="white"/>
			</svg>
		</div>
	</div>
</div>
</div>