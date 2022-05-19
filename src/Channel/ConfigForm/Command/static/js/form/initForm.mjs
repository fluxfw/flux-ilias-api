import {initEntriesForm} from "./entries/initEntriesForm.mjs";
import {initScheduleForm} from "./schedule/initScheduleForm.mjs";

export function initForm(form_template_el, action, values) {
    const form_el = form_template_el.content.firstElementChild.cloneNode(true);

    form_el.elements.enable_api_proxy.checked = values.enable_api_proxy;
    form_el.elements.enable_log_changes.checked = values.enable_log_changes;
    form_el.elements.enable_purge_changes.checked = values.enable_purge_changes;
    form_el.elements.enable_rest_api.checked = values.enable_rest_api;
    form_el.elements.enable_transfer_changes.checked = values.enable_transfer_changes;
    form_el.elements.enable_web_proxy.checked = values.enable_web_proxy;
    form_el.elements.keep_changes_inside_days.valueAsNumber = values.keep_changes_inside_days;
    form_el.elements.transfer_changes_post_url.value = values.transfer_changes_post_url;

    form_el.elements.enable_transfer_changes.addEventListener("change", changedEnableTransferChanges);
    changedEnableTransferChanges();

    const entries_template_el = form_el.querySelector("[data-entries-template]");
    entries_template_el.remove();
    initEntriesForm("web_proxy_map", entries_template_el, ["iframe_url", "menu_item", "rewrite_url", "target_key", "visible_public_menu_item"], values, form_el, (entry_el) => {
        const target_key_el = entry_el.querySelector("[data-entry-target_key]");
        const target_url_el = entry_el.querySelector("[data-entry-target-url]");
        const menu_item_el = entry_el.querySelector("[data-entry-menu_item]");
        const visible_public_menu_item_el = entry_el.querySelector("[data-entry-visible_public_menu_item]");
        const visible_public_menu_item_info_el = entry_el.querySelector("[data-entry-visible-public-menu-item-info]");

        target_key_el.addEventListener("input", changedTargetKey);
        changedTargetKey();

        menu_item_el.addEventListener("input", changedMenuItem);
        changedMenuItem();

        visible_public_menu_item_el.addEventListener("input", changedVisiblePublicMenuItem);
        changedVisiblePublicMenuItem();

        function changedTargetKey() {
            target_url_el.innerText = `${location.origin}/goto.php?target=flilre_web_proxy_${target_key_el.value}`;
        }

        function changedMenuItem() {
            const old_disabled = visible_public_menu_item_el.disabled;

            visible_public_menu_item_el.disabled = !menu_item_el.checked;

            if (old_disabled !== visible_public_menu_item_el.disabled) {
                visible_public_menu_item_el.checked = false;
            }

            changedVisiblePublicMenuItem();
        }

        function changedVisiblePublicMenuItem() {
            visible_public_menu_item_info_el.innerText = menu_item_el.checked && !visible_public_menu_item_el.checked ? "Note: Your iframe url is still accessible for public nevertheless you disabled it" : "";
        }
    });
    initEntriesForm("api_proxy_map", entries_template_el, ["target_key", "url"], values, form_el, (entry_el) => {
        const target_key_el = entry_el.querySelector("[data-entry-target_key]");
        const target_url_el = entry_el.querySelector("[data-entry-target-url]");

        target_key_el.addEventListener("input", changedTargetKey);
        changedTargetKey();

        function changedTargetKey() {
            target_url_el.innerText = `${location.origin}/goto.php?target=flilre_api_proxy_${target_key_el.value}`;
        }
    });

    const schedule_template_el = form_el.querySelector("[data-schedule-template]");
    schedule_template_el.remove();
    initScheduleForm("purge_changes_schedule", schedule_template_el, values, form_el);
    initScheduleForm("transfer_changes_schedule", schedule_template_el, values, form_el);

    form_el.querySelector("[data-store]").addEventListener("click", action);

    return form_el;

    function changedEnableTransferChanges() {
        form_el.elements.transfer_changes_post_url.required = form_el.elements.enable_transfer_changes.checked;
    }
}
