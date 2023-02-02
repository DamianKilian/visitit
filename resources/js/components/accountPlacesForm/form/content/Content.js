import { useRef, useEffect } from "react";
import cx from "classnames";
import Trix from "trix";

import trixLoadAttachment from "./trixLoadAttachment";

function Content() {
    const trixInput = useRef();
    useEffect(() => {
        trixInput.current.addEventListener("trix-attachment-add", function (e) {
            if (e.attachment.file) {
                trixLoadAttachment(e.attachment);
            }
        });
    }, []);

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
                    "border border-3 border-danger": error.content,
                })}
            ></trix-editor>
            <span className="invalid-feedback d-block" role="alert">
                <strong>{error.content}</strong>
            </span>
        </div>
    );
}

export default Content;
