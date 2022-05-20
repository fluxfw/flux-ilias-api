import {getEntriesFormValue} from "./entries/getEntriesFormValue.mjs";
import {getScheduleFormValue} from "./schedule/getScheduleFormValue.mjs";
import {insertError} from "../loading/insertError.mjs";
import {insertLoading} from "../loading/insertLoading.mjs";
import {storeValues} from "../fetch/storeValues.mjs";

export async function storeForm(form_el) {
    if (!form_el.checkValidity()) {
        form_el.reportValidity();
        return;
    }

    const restore_disabled = [];
    for (const input_el of form_el.elements) {
        if (input_el.disabled) {
            restore_disabled.push(input_el);
        }
        input_el.disabled = true;
    }

    const values = {
        api_proxy_map: getEntriesFormValue("api_proxy_map", ["target_key", "url"], form_el),
        enable_api_proxy: form_el.elements.enable_api_proxy.checked,
        enable_log_changes: form_el.elements.enable_log_changes.checked,
        enable_purge_changes: form_el.elements.enable_purge_changes.checked,
        enable_rest_api: form_el.elements.enable_rest_api.checked,
        enable_transfer_changes: form_el.elements.enable_transfer_changes.checked,
        enable_web_proxy: form_el.elements.enable_web_proxy.checked,
        keep_changes_inside_days: form_el.elements.keep_changes_inside_days.valueAsNumber,
        purge_changes_schedule: getScheduleFormValue("purge_changes_schedule", form_el),
        transfer_changes_post_url: form_el.elements.transfer_changes_post_url.value,
        transfer_changes_schedule: getScheduleFormValue("transfer_changes_schedule", form_el),
        web_proxy_iframe_height_offset: form_el.elements.web_proxy_iframe_height_offset.valueAsNumber,
        web_proxy_map: getEntriesFormValue("web_proxy_map", ["iframe_url", "menu_item", "rewrite_url", "target_key", "title", "visible_public_menu_item"], form_el)
    };

    const loading_el = insertLoading(form_el);
    try {
        await storeValues(values);
    } catch (err) {
        insertError(err, "Form could not be stored", form_el);
        return;
    } finally {
        loading_el.remove();
    }

    for (const input_el of form_el.elements) {
        input_el.disabled = restore_disabled.includes(input_el);
    }
}
