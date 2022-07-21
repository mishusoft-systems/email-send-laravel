import {useState} from "react";
import {swal} from "sweetalert2"

export default () => {

    const defaultMailStatus = {
        users: [],
        messages: [],
        send_now: true,
        loading: false,
        title: '',
        body: '',
        send_date: '',
        item: 'now'
    }
    const [mailStatus, updateMailStatus] = useState(defaultMailStatus);

    const SendEmail = (event) => {
        event.preventDefault();
        // Update loading status
        updateMailStatus((prevState)=>({...prevState, loading: true}))

        const sendData = {
            title: this.title,
            body: this.body,
            send_date: this.send_date,
            item: this.item
        }
        axios.post('/notifications', sendData)
            .then((resp) => {
                console.log(resp);
                $('#create_form_modal').modal('hide');
                if (this.item === 'now') {
                    swal(
                        'Sent!',
                        'Email Sent to Users',
                        'success'
                    )
                } else {
                    swal(
                        'Scheduled!',
                        'Email Scheduled! To Be Sent Later',
                        'success'
                    )
                }

                updateMailStatus((prevState)=>({...prevState, title:'', body: '', loading: false}));
                console.log(resp)
                setTimeout(() => {
                    window.location.reload(window.origin + '/');
                }, 5000)
            })
            .catch(error => console.log(error))
    }

    return (
        <>
        <div>
            <div className="card col-md-8 offset-md-2" style="margin-top: 20px;">
                <div className="card-header">
                    <div style="display:flex; justify-content: space-between;">
                        <h2>Email List</h2>
                        <a id="create_form_icon" href="#"
                           className="btn btn-lg btn-primary" onClick={(event) => {
                            event.preventDefault();
                            // @click="openModal"
                        }}>
                            <i className="plus icon"></i>Send Email
                        </a>
                    </div>
                </div>
                <div style="">
                    <table className="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Added</th>
                        </tr>
                        </thead>
                        <tbody>
                        {mailStatus.users.map((user) => (
                            <tr key={user.id}>
                                <td style="width: 33%">{user.name}</td>
                                <td style="width: 43%">{user.email}</td>
                                <td style="width: 23%">{user.created_at}</td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                </div>
            </div>

            <div className="card col-md-8 offset-md-2" style="margin-top: 30px;">
                <div className="card-header">
                    <h2>Sent Messages</h2>
                </div>
                <div style="margin-top: 20px;">
                    <table className="table table-bordered">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Delivered</th>
                            <th>Sent Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        {mailStatus.messages.map((message) => (
                            <tr key={message.id}>
                                <td style="width: 30%">{message.title}</td>
                                <td style="width: 43%">{message.body}</td>
                                <td style="width: 10%">{message.delivered}</td>
                                <td style="width: 15%">{message.send_date}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>


        <!-- The Modal -->
        <div className="modal fade" id="create_form_modal" tabIndex="-1" role="dialog"
             aria-labelledby="addNewLabel" aria-hidden="true">
            <div className="modal-dialog modal-dialog-centered" role="document">
                <div className="modal-content">
                    <div className="modal-header">
                        <h5 className="modal-title" id="addNewLabel">Send Email</h5>
                        <button type="button" className="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form onSubmit={SendEmail}>
                    <div className="modal-body">
                        <div className="form-group">
                            <label>Title of Email</label>
                            <input type="text" name="title" placeholder="Email Title" className="form-control">
                        </div>
                        <div className="form-group">
                            <label>Email body</label>
                            <textarea name="body" id="body" placeholder="Body of message" className="form-control" rows="5">
                        </textarea>
                        </div>
                        <div className="form-group">
                            <label style="margin-bottom: 10px;">When to Send:</label>
                            <div className="form-control">
                            <span style="margin-right: 20px;">
                                <input type="radio" name="sending" value="now" checked onChange={()=>{
                                    updateMailStatus(prevState => ({...prevState, item:'now'}));
                                }}/>
                                <label>Send Now</label>
                            </span>
                                <span>
                                <input type="radio" name="sending" value="later"/>
                                <label>Send Later</label>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div className="form-control" v-if="item === 'later'">
                        <VueCtkDateTimePicker :no-button-now = "true"
                        v-model="send_date"
                        />
                    </div>

                    <div className="modal-footer">
                        <button
                        :disabled="disabled" v-if="loading && item === 'now'"
                        type="submit" className="btn btn-success">
                        Sending Email...
                    </button>
                    <button
                    :disabled="disabled"
                    v-if="!loading && item === 'now'"
                    type="submit" className="btn btn-success">
                    Send Email
                </button>
                <button
                    v-if="!loading && item === 'later'"
                :disabled="disabled"
                type="submit"
                className="btn btn-success"
                >
                Send Later
            </button>
        </div>
        </form>
</div>
</div>
</div>
    <!-- End Modal -->
</div>
</>
)
    ;

}
