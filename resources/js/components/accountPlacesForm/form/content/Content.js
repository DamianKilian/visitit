import { useRef, useEffect, useState } from "react";
import cx from "classnames";
import Trix from "trix";

import trixLoadAttachment from "./trixLoadAttachment";

function Content() {
    const [err, setErr] = useState(error.content)
    const trixInput = useRef();
    useEffect(() => {
        trixInput.current.addEventListener("trix-attachment-add", function (e) {
            if (e.attachment.file) {
                trixLoadAttachment(e.attachment, attachmentErrorHandler);
            }
        });
        
        Trix.config.attachments.preview.caption = { name: false, size: false };
    }, []);

    function attachmentErrorHandler(attachment, msg) {
        setTimeout(() => {
            attachment.remove();
        }, 1000);
        setErr(msg);
    }

    function clearContentErr() {
        setErr('');
    }

    return (
        <div className="mb-3">
            <label className="form-label">{__("Content")}</label>
            <input
                defaultValue={old.content}
                id="x"
                type="hidden"
                name="content"
            />
            <trix-editor
                ref={trixInput}
                input="x"
                class={cx("trix-content", {
                    "border border-3 border-danger": err,
                })}
            ></trix-editor>
            <span className="invalid-feedback d-block" role="alert">
                <strong>{err}</strong> {err && <button className="btn btn-secondary" type="button" onClick={clearContentErr}>ok</button>}
            </span>
        </div>
    );
}

export default Content;
