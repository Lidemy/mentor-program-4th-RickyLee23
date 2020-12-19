import styled from "styled-components";
import React from "react";

const FormWrapper = styled.div`
  width: 645px;
  box-shadow: -1.4px -1.4px 6px 0 #97a2a0;
  margin: 120px auto;
  padding-bottom: 35px;
`;
const NavBar = styled.div`
  height: 8px;
  background: #fad312;
`;
const TitleContainer = styled.div`
  margin-left: 42px;
  margin-top: 54px;
`;
const Title = styled.div`
  font-size: 36px;
  font-weight: bold;
`;
const ActivityDate = styled.div`
  margin-top: 35px;
`;
const ActivityLocation = styled.div`
  margin-top: 11px;
`;
const Caution = styled.div`
  color: #e74149;
  font-size: 16px;
  margin-top: 22px;
`;
const InformationInsert = styled.div`
  font-weight: normal;
  font-size: 20px;
`;
const PersonalInformation = styled.div`
  margin: 30px 0px 30px 42px;
  margin-bottom: 50px;
`;
const InformationTitle = styled.div`
  font-weight: normal;
  font-size: 20px;
`;
const InformationInput = styled.input`
  font-family: inherit;
  font-size: 16px;
  margin-top: 20px;
`;
const Suggestion = styled.div`
  font-size: 14px;
  margin-top: 12px;
`;
const SubmitButton = styled.button`
  font-size: 15px;
  background: #fad312;
  padding: 13px 32px 13px 31px;
  margin-bottom: 21px;
  text-align: center;
  display: inline-block;
  border-radius: 5px;
  margin-left: 42px;
`;
const Notice = styled.div`
  font-size: 14px;
  margin-left: 42px;
`;
const TypeOption = styled.div`
  font-size: 14px;
  font-weight: normal;
  margin-top: 20px;
`;
const Warning = styled.h1.attrs({
  children: "請把資料填寫完整喔～",
})`
  color: red;
  font-size: 14px;
`;

function App() {
  const [formValue, setFormValue] = React.useState({
    nickname: "",
    email: "",
    phone: "",
    option: "",
    howYouKnow: "",
    else: "",
    completed: null, //表單完成度，null 或 false 或 true
  });

  function handleChange(e) {
    const target = e.target;
    const name = target.name;
    const value =
      target.type === "radio" ? target.parentNode.innerText : target.value;
    setFormValue({
      ...formValue,
      [name]: value,
    });
  }

  function handleSubmit(e) {
    // 選項檢查是否為空，是空值出現紅字警示
    if (
      formValue.nickname === "" ||
      formValue.email === "" ||
      formValue.phone === "" ||
      formValue.option === "" ||
      formValue.howYouKnow === ""
    ) {
      setFormValue({
        ...formValue,
        completed: false, //表單未完成
      });
    } else {
      setFormValue({
        ...formValue,
        completed: true, //表單已完成
      });
      alert(`
      已提交資料！
      
      暱稱 : ${formValue.nickname}
      電子郵件 : ${formValue.email}
      手機號碼 : ${formValue.phone}
      報名類型 : ${formValue.option}
      怎麼知道這活動的 : ${formValue.howYouKnow}
      其他 : ${formValue.else}`);
    }
  }

  return (
    <FormWrapper>
      <NavBar />
      <TitleContainer>
        <Title>新拖延運動報名表單</Title>
        <ActivityDate>
          <p>活動日期：2020/12/10 ~ 2020/12/11</p>
        </ActivityDate>
        <ActivityLocation>
          <p>活動地點：台北市大安區新生南路二段1號</p>
        </ActivityLocation>
        <Caution>* 必填</Caution>
      </TitleContainer>
      <InformationInsert>
        <PersonalInformation>
          <InformationTitle>
            暱稱<span style={{ color: "red" }}> ＊</span>
          </InformationTitle>
          <InformationInput
            placeholder="您的回答"
            name="nickname"
            value={formValue.nickname}
            onChange={handleChange}
          ></InformationInput>
          {formValue.completed === false && formValue.nickname === "" ? (
            <Warning />
          ) : (
            ""
          )}
        </PersonalInformation>
        <PersonalInformation>
          <InformationTitle>
            電子郵件<span style={{ color: "red" }}> ＊</span>
          </InformationTitle>
          <InformationInput
            placeholder="您的電子郵件"
            name="email"
            value={formValue.email}
            onChange={handleChange}
          ></InformationInput>
          {formValue.completed === false && formValue.email === "" ? (
            <Warning />
          ) : (
            ""
          )}
        </PersonalInformation>
        <PersonalInformation>
          <InformationTitle>
            手機號碼<span style={{ color: "red" }}> ＊</span>
          </InformationTitle>
          <InformationInput
            placeholder="您的手機號碼"
            name="phone"
            value={formValue.phone}
            onChange={handleChange}
          ></InformationInput>
          {formValue.completed === false && formValue.phone === "" ? (
            <Warning />
          ) : (
            ""
          )}
        </PersonalInformation>
        <PersonalInformation>
          <InformationTitle>
            報名類型<span style={{ color: "red" }}> ＊</span>
          </InformationTitle>
          <TypeOption>
            <input type="radio" name="option" onChange={handleChange}></input>
            躺在床上用想像力實作
          </TypeOption>
          <TypeOption>
            <input type="radio" name="option" onChange={handleChange}></input>
            趴在地上滑手機找現成的
          </TypeOption>
          {formValue.completed === false && formValue.option === "" ? (
            <Warning />
          ) : (
            ""
          )}
        </PersonalInformation>
        <PersonalInformation>
          <InformationTitle>
            怎麼知道這個活動的？<span style={{ color: "red" }}> ＊</span>
          </InformationTitle>
          <InformationInput
            placeholder="您的回答"
            name="howYouKnow"
            value={formValue.howYouKnow}
            onChange={handleChange}
          ></InformationInput>
          {formValue.completed === false && formValue.howYouKnow === "" ? (
            <Warning />
          ) : (
            ""
          )}
        </PersonalInformation>
        <PersonalInformation>
          <InformationTitle>其他？</InformationTitle>
          <Suggestion>對活動的一些建議</Suggestion>
          <InformationInput
            placeholder="您的回答"
            name="else"
            value={formValue.else}
            onChange={handleChange}
          ></InformationInput>
        </PersonalInformation>
        <SubmitButton onClick={handleSubmit}>提交</SubmitButton>
        <Notice>請勿透過表單送出您的密碼。</Notice>
      </InformationInsert>
    </FormWrapper>
  );
}

export default App;
