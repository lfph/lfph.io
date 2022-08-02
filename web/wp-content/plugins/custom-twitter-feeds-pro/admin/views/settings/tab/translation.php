<div v-if="selected === 'app-3'">
    <div class="sb-tab-box sb-custom-text-box d-flex">
        <div class="tab-label tab-label-full">
            <h3>{{translationTab.title}}</h3>
            <span class="sb-help-text">{{translationTab.description}}</span>

            <div class="sb-tab-inner-card">
                <table class="ctf-table">
                    <thead>
                        <tr>
                            <th>{{translationTab.table.originalText}}</th>
                            <th>{{translationTab.table.customText}}</th>
                            <th>{{translationTab.table.context}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="ctf-table-row-header">
                            <td colspan="3">{{translationTab.table.tweetText}}</td>
                        </tr>
                        <tr>
                            <td>{{translationTab.table.retweeted}}</td>
                            <td><input type="text" class="ctf-input" :placeholder="model.translation.retweeted" v-model:value="model.translation.retweetedtext"></td>
                            <td>{{translationTab.table.retweetedCtnx}}</td>
                        </tr>
                        <tr>
                            <td>{{translationTab.table.inReplyTo}}</td>
                            <td><input type="text" class="ctf-input" :placeholder="model.translation.inReplyTo" v-model:value="model.translation.inreplytotext"></td>
                            <td>{{translationTab.table.inReplyToCtnx}}</td>
                        </tr>
                        <tr>
                            <td>{{translationTab.table.loadMore}}</td>
                            <td><input type="text" class="ctf-input" :placeholder="model.translation.loadMore" v-model:value="model.translation.buttontext"></td>
                            <td>{{translationTab.table.loadMoreCtnx}}</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr class="ctf-table-row-header">
                            <td colspan="3">{{translationTab.table.date}}</td>
                        </tr>
                        <tr>
                            <td>{{translationTab.table.mtime}}</td>
                            <td><input type="text" class="ctf-input" :placeholder="translationTab.table.mtime" v-model:value="model.translation.mtime"></td>
                            <td>{{translationTab.table.usedinTimeline}}</td>
                        </tr>
                        <tr>
                            <td>{{translationTab.table.htime}}</td>
                            <td><input type="text" class="ctf-input" :placeholder="translationTab.table.htime" v-model:value="model.translation.htime"></td>
                            <td>{{translationTab.table.usedinTimeline}}</td>
                        </tr>
                        <tr>
                            <td>{{translationTab.table.nowtime}}</td>
                            <td><input type="text" class="ctf-input" :placeholder="translationTab.table.nowtime" v-model:value="model.translation.nowtime"></td>
                            <td>{{translationTab.table.usedinTimeline}}</td>
                        </tr>

                    </tbody>

                    <tfoot>
                        <tr>
                            <th>{{translationTab.table.originalText}}</th>
                            <th>{{translationTab.table.customText}}</th>
                            <th>{{translationTab.table.context}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- todo: this is just demo content and will be replaced once I work on this -->
