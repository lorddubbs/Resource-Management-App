import { createLocalVue, shallowMount } from "@vue/test-utils";
import Vuex from 'vuex';
import CreateAsset from "@/common/components/forms/CreateAsset";

const localVue = createLocalVue();
localVue.use(Vuex);

describe("CreateAsset", () => {
    
     let actions;
     let store;

     beforeEach(() => {

       actions = {
         createAsset: jest.fn()
       }

       store = new Vuex.Store({
         modules: {
          asset: {
            actions,
            namespaced: true
          }
         }
       })
     })

  it("sets all accurate data and simulates a submission", async () => {
    const contentType = 'pdf';
    const wrapper = shallowMount(CreateAsset, { store, localVue,
      propsData: {
        assetType: contentType
      }
    });
    // checks if the component name is accurate
    expect(wrapper.vm.$options.name).toMatch('CreateAsset');
    
    // create mock pdf file
    const content = { 
      size: 1000, 
      type: "application/pdf", 
      name: "resume.pdf"
    };

    // mock the onchange event 
    const event = { 
      target: { 
        files: [content]
      }
    };

    // check if the file is same as content
    expect(wrapper.vm.getFile(event)).toEqual(content);

    // set input data
    
    expect(wrapper.setData({
      title: 'Commercialize Space Travel',
      type: contentType,
      description: 'Richard Branson, Elon Musk and Space Exploration',
      option: '0',
      content: content
    }));
    
    await wrapper.find('button').trigger('click');
    expect(actions.createAsset).toHaveBeenCalled()
  });
});
