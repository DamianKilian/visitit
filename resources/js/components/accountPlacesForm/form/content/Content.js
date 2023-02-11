import { useRef, useEffect, useState } from "react";
import cx from "classnames";
import Trix from "trix";

import trixLoadAttachment from "./trixLoadAttachment";

function Content() {
    const [err, setErr] = useState(error.content);
    const trixInput = useRef();
    useEffect(() => {
        trixInput.current.addEventListener("trix-attachment-add", function (e) {
            if (e.attachment.file && validateAttachment(e.attachment)) {
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
        setErr("");
    }

    function validateAttachment(attachment) {
        const mimesStr = "jpg,jpeg,png,gif,svg,txt,pdf,doc,docx";
        const mimes = mimesStr.split(",");
        const maxKb = 2048;
        const max = maxKb * 1024;
        const matchMime = mimes.find(
            (mime) => mime === attachment.getExtension()
        );
        const checkFileSize = attachment.getFilesize() <= max;
        if (matchMime && checkFileSize) {
            return true;
        } else {
            if (!matchMime) {
                attachmentErrorHandler(
                    attachment,
                    __("File type must be one of the following: ") + mimesStr
                );
            } else if (!checkFileSize) {
                attachmentErrorHandler(
                    attachment,
                    __("Max file size is: ") + maxKb + "Kb"
                );
            }
            return false;
        }
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
                <strong>{err} </strong>
                {err && (
                    <button
                        className="btn btn-secondary"
                        type="button"
                        onClick={clearContentErr}
                    >
                        ok
                    </button>
                )}
            </span>
        </div>
    );
}

export default Content;
